<?php
require_once("../../libs/zapcalendar/zapcallib.php");

const GROUPS_ENUM = [
    "9298", "9299", "9300", "9301", "9302", "9309",     // S1 G1-2-3-4-5-6
    "9303", "9304", "9305", "9306", "9310",             // S2 G1-2-3-4-6
    "9311", "9312", "9313", "9314", "9292",             // S3 G1-2-3-4-6
    "9315", "9316", "9317", "9318", "9293", "5484",     // S4 G1-2-3-4-6A-6B
    "9272", "18783"                                     // ASPE1, ASPE2
];

//todo: add remaining classrooms
const CLASSROOMS_ENUM = [
    "Amphi1", "Amphi2",
    "S03", "026-Langues", "028", "040",
    "S12", "S13", "S14", "S16", "S17", "S18 - TP Réseau",
    "S24", "S25-Salle de réunion", "S26",
];

function parse_edt_url($group_id, $first_date, $last_date): string | int
{

     foreach (GROUPS_ENUM as $group)
         if ($group_id === $group)
             return "https://adelb.univ-lyon1.fr/jsp/custom/modules/plannings/anonymous_cal.jsp"
                 ."?resources=$group_id&projectId=1&calType=ical&firstDate=$first_date&lastDate=$last_date";

     return 1;
}

function parse_description($description, $professor_name): int
{
    $lines = explode("\n", $description);
    for ($i = 1; $i < sizeof($lines) -1; $i++)
        if (strcasecmp($lines[$i], $professor_name) == 0)
            return 1;

    return 0;
}

function parse_edt_by_professor($professor_name, $first_date, $last_date): array | int
{
    $date_str = "&projectId=1&calType=ical&firstDate=$first_date&lastDate=$last_date";
    $e_array = array();
    foreach (GROUPS_ENUM as $group)
    {
        $ical_content = file_get_contents("https://adelb.univ-lyon1.fr/jsp/custom/modules/plannings/anonymous_cal.jsp"
            ."?resources=$group".$date_str);
        if(!$ical_content)
            return 1;

        try {
            $ical = new ZCiCal($ical_content);
        } catch(Exception) {
            return 1;
        }

        foreach ($ical->tree->child as $event)
            if ($event->getName() == "VEVENT")
                foreach ($event->data as $key => $value)
                    if($key == "DESCRIPTION")
                        if (parse_description($value->getValues(), $professor_name))
                            $e_array[] = $event;
    }

    return $e_array;
}

function parse_edt_by_group($group_id, $first_date, $last_date): array | int
{
    $url = parse_edt_url($group_id, $first_date, $last_date);
    if ($url === 1)
        return 1;

    $e_array = array();
    $ical_content = file_get_contents($url);
    if(!$ical_content)
            return 1;

    try{
        $ical = new ZCiCal($ical_content);
    } catch(Exception) {
        return 1;
    }

    foreach ($ical->tree->child as $event)
        if ($event->getName() == "VEVENT")
            $e_array[] = $event;

    return $e_array;
}

function parse_location($location, $occupied_classes)
{
    $lines = explode(",", $location);
    foreach ($lines as $class)
    {
        foreach ($occupied_classes as $occupied)
            if ($class === $occupied)
                break;

        $occupied_classes[] = $class;
    }
}

/*
 * Creates a hashmap to store all occupied classrooms with key -> datetime string
 * and value -> array of occupied classrooms for the specific datetime.
 * It then loops through the occupied classrooms and creates an event each 2 hours
 * with all unoccupied classrooms for the specific 2hours interval.
 * After this process all events are written inside an ics file.
 */
/*
function create_ics_from_empty_classrooms($first_date, $last_date): array | int //todo
{
    $occupied_classes = array();
    $date_str = "&projectId=1&calType=ical&firstDate=$first_date&lastDate=$last_date";
    foreach (GROUPS_ENUM as $group)
    {
        $ical_content = file_get_contents("https://adelb.univ-lyon1.fr"
                        ."/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=$group".$date_str);

        try {
            $ical = new ZCiCal($ical_content);
        } catch(Exception) {
            return 1;
        }

        foreach ($ical->tree->child as $event)
            if ($event->getName() == "VEVENT")
            {
                $tmp_values = array();
                foreach ($event->data as $key => $value)
                {
                    if ($key == "LOCATION")
                        parse_location($value->getValues(), $occupied_classes);

                    if ($key == "" )
                }

            }

    }

    $e_array = array();
    foreach (CLASSROOMS_ENUM as $class)
    {

        foreach ($occupied_classes as $occupied)
    }

    return $e_array;
}
*/

/*
 * e_attributes describes each event with its
 * corresponding attributes formatted as bellow:
 * Index -> Value of attribute
 * 0 -> DTSTAMP
 * 1 -> DTSTART
 * 2 -> DTEND
 * 3 -> SUMMARY
 * 4 -> LOCATION
 * 5 -> DESCRIPTION
 * 6 -> UID
 * ... //todo: might need more attributes
 */
function create_ics_from_event_array($events): int
{
    $ical = new ZCiCal();
    foreach ($events as $event)
    {
        $e_ical = new ZCiCalNode("VEVENT", $ical->curnode);
        foreach ($event->data as $key => $value)
        {
            switch ($key)
            {
                case "DTSTAMP":
                    $e_ical->addNode(new ZCiCalDataNode("DTSTAMP:".$value->getValues()));
                    break;

                case "DTSTART":
                    $e_ical->addNode(new ZCiCalDataNode("DTSTART:".$value->getValues()));
                    break;

                case "DTEND":
                    $e_ical->addNode(new ZCiCalDataNode("DTEND:".$value->getValues()));
                    break;

                case "SUMMARY":
                    $e_ical->addNode(new ZCiCalDataNode("SUMMARY:".$value->getValues()));
                    break;

                case "LOCATION":
                    $e_ical->addNode(new ZCiCalDataNode("LOCATION:".$value->getValues()));
                    break;

                case "DESCRIPTION":
                    $e_ical->addNode(new ZCiCalDataNode("DESCRIPTION:".$value->getValues()));
                    break;

                case "UID":
                    $e_ical->addNode(new ZCiCalDataNode("UID:".$value->getValues()));
                    break;

                //case "CREATED":
                //    $e_ical->addNode(new ZCiCalDataNode("CREATED:".ZCiCal::fromSqlDateTime()));
            }
        }
    }

    $ical_file = fopen("../../ics_files/ical.ics", "w"); //todo: change file name depending on professor name
    if ($ical_file == 0)
        return 1;

    $ret = fwrite($ical_file, $ical->export());
    if ($ret == 0)
        return 1;

    fclose($ical_file);
    return 0;
}

function print_events($events)
{
    foreach ($events as $event)
        foreach ($event->data as $key => $value)
            if ($key == "SUMMARY" || $key == "DESCRIPTION")
                echo $value->getValues();
}

$first_date = "2022-01-10";
$last_date = "2022-01-16";
$group_id = "9311"; //G1S3

/*
$events = parse_edt_by_professor("watrigant remi", $first_date, $last_date);
if ($events === 1)
    exit("Error: Parsing edt by professor failed\n");
//print_events($events);
*/

/*
$events = parse_edt_by_group($group_id, $first_date, $last_date);
if ($events === 1)
    exit("Error: Parsing edt by group failed\n");
*/

/*
$events = create_ics_from_empty_classrooms($first_date, $last_date);
if ($events === 1)
    exit("Error: Calendar from empty classrooms could not be created\n");
*/

$ret = create_ics_from_event_array($events);
if ($ret === 1)
    exit("Error: Calendar could not be created\n");

// echo "test: ".ZCiCal::toSqlDateTime("20220103T215853Z")."\n";
// echo "test: ".ZCiCal::fromSqlDateTime("2020-01-01 12:00:00")."\n";
// echo "test: ".ZDateHelper::toiCalDateTime("2020-01-01 12:00:00")."\n";
// echo "test: ".ZDateHelper::fromiCaltoUnixDateTime("20220103T215853Z")."\n"; //todo: review
?>
