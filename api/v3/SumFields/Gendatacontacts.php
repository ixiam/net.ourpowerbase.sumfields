<?php

/**
 * Api to generate the summary info avoiding problems timeout in database
 *
 * @param array $params
 * @return void
 */
function civicrm_api3_sum_fields_gendatacontacts($params) {
  $query = "SELECT id FROM civicrm_contact";
  $dao = CRM_Core_DAO::executeQuery($query);
  $contact_ids = [];
  while ($dao->fetch()) {
    $contact_ids[] = $dao->id;
  }

  $contacts_chunk = array_chunk( $contact_ids , 100);

  foreach ($contacts_chunk as $key => $contacts) {
    $contacts_string =  implode("," , $contacts);
    sumfields_generate_data_based_on_current_data(NULL, $contacts_string);
  }
}