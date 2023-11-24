<?php

declare(strict_types=1);

//for labTest
function isInputEmpty(string $Test_code, string $Test_name, string $Description, string $Cost): bool {
    if (empty($Test_code) || empty($Test_name) || empty($Description) || empty($Cost)) {
        return true;
    } else {
        return false;
    }
}
function isCostFloat(string $Cost): bool {
    if (is_numeric($Cost)) {
        return true;
    } else {
        return false;
    }
}

//for patientsResults
function isPRInputEmpty(string $Report_url, string $Interpretation): bool {
    if (empty($Report_url) || empty($Interpretation)) {
        return true;
    } else {
        return false;
    }
}
function isURL(string $Report_url): bool {
    if (filter_var($Report_url, FILTER_VALIDATE_URL)) {
        return true;
    } else {
        return false;
    }
}




function isRowIndexInt(string $rowIndex): bool {
    if (is_numeric($rowIndex)) {
        return true;
    } else {
        return false;
    }
}