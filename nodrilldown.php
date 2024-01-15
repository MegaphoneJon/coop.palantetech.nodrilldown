<?php

require_once 'nodrilldown.civix.php';

/**
 * Implements hook_civicrm_alterReportVar().
 *
 * @link
 * http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterReportVar
 */
function nodrilldown_civicrm_alterReportVar($varType, &$var, &$object) {
  if ($varType == 'rows') {
    //WordPress URLs are constructed a bit differently - let's ID and modify accordingly.
    $cms = CRM_Core_Config::singleton()->userFramework;
    $separator = ($cms == 'WordPress' ? '&' : '?');
    $doReplace = FALSE;
    /* $pattern = '/civicrm\/report\/instance\/\d*(\?|&amp;)reset=1&amp;force=1&amp;id_op=eq&amp;id_value=/'; */
    $pattern = '/civicrm(\/|%2F)report(\/|%2F)instance(\/|%2F)\d*(\?|&amp;|&)reset=1(&amp;|&)force=1(&amp;|&)id_op=eq(&amp;|&)id_value=/';
    $replace = "civicrm/contact/view{$separator}reset=1&cid=";
    $link = 'civicrm_contact_sort_name_link';

    if ($object instanceOf CRM_Report_Form_Campaign_SurveyDetails) {
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contact_CurrentEmployer) {
      $link = 'civicrm_employer_organization_name_link';
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contact_Relationship) {
      $link = 'civicrm_contact_sort_name_a_link';
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contact_Summary) {
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contribute_Sybunt) {
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contribute_HouseholdSummary) {
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contribute_Repeat) {
      $link = 'contact_civireport_sort_name_link';
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contribute_Summary) {
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contribute_History) {
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contribute_SoftCredit) {
      $link = 'civicrm_contact_display_name_constituent_link';
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contribute_OrganizationSummary) {
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contribute_Lybunt) {
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Contribute_TopDonor) {
      $link = 'civicrm_contact_display_name_link';
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Event_ParticipantListing) {
      $link = 'civicrm_contact_sort_name_linked';
      $doReplace = TRUE;
    }
    if ($object instanceOf CRM_Report_Form_Member_Lapse) {
      $doReplace = TRUE;
    }

    if ($doReplace) {
      foreach ($var as $i => $row) {
        if (array_key_exists($link, $row)) {
          $var[$i][$link] = preg_replace($pattern, $replace, $row[$link]);
        }
      }
    }
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function nodrilldown_civicrm_config(&$config) {
  _nodrilldown_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function nodrilldown_civicrm_install() {
  _nodrilldown_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function nodrilldown_civicrm_enable() {
  _nodrilldown_civix_civicrm_enable();
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

*/
