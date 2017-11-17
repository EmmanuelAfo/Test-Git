<?php
// You will be using the Users tracking info. I assume the user will supply this, all you have to do is to create a
// for that GET or POST that Awbno to  this code and save is as

// $tracking_code = $_POST('form_input_id');
// if you are using POST or

// $tracking_code = $_GET('form_input_id');
// if you are using GET - get id from URL

// But, In my own case, I am assuming I already got it, so.
// also, don't forget to escape form info and give a default message if there is no information gotten from the API.
if (!empty($_POST)){
//$tracking_id = '15499115';
$tracking_id = $_POST['Awbno'];
$response = file_get_contents('https://www.redstarplc.com:8444/TrackingService/Tracking.asmx/Tracking_Fetch?Awbno=' . $tracking_id);
?>
<!-- Let's build a UI with that data -->
<div>
    <?php
        if (!$response) {
            echo '<h1>There are no data for this tracking code</h1>';
        } else {
            $xml = new SimpleXMLElement($response);
            $data = json_decode($xml[0], true); ?>
        <table>
            <h1>
                AWBNO: <?= $tracking_id; ?>
            </h1>
            <thead>
                <td style="padding: 20px;">Date</td>
                <td style="padding: 20px;">Time</td>
                <td style="padding: 20px;">Status</td>
            </thead>
            <tbody>
            <?php
                foreach($data['Table'] as $x => $a) { ?>
                    <tr>
                        <td style="padding: 20px;"><?= date('d/m/Y', strtotime($a['Date'])) ?></td>
                        <td style="padding: 20px;"><?= date('H:i:s', strtotime($a['Date'])) ?></td>
                        <td style="padding: 20px;"><?= $a['Status'] ?></td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <?php }else { ?>
    	<span style="width: 100%">
           <form action="" method="post">
               <input type="text" class="record_id" name="Awbno" value="" placeholder="Enter your tracking numbers" style="width: 100%;"><br><br>
           	<input type="submit" name="submit" class="modalLink btn-red" value="Track">
           </form>
       </span>
    	<?php } ?>
</div>