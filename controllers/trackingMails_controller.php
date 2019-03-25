<?php

class TrackingMailsController extends Controller
{
    public function actionIndex () {

        $this->view->page = "trackingMails/tracking_mails.php";
        $this->view->render('');
    }

    /**
     * метод загружающий страницу отслеживания отправлений
     */
    public function actionGetInfo () {
        $numberId = new NumberId();
        $mail = new RegisteredMail();
        $sender = new Sender();
        $addressee = new Addressee();
        //проверяем получен ли суперглобальный массив
        if (!empty($_POST['number_id'])) {
            // проверяем на количество символов и является ли полученое число номером
            if ((strlen($_POST['number_id']) == 14) && is_numeric($_POST['number_id'])) {
                $mail->numberId = $_POST['number_id'];
                $search = $mail->getOneMailByNumberID();
                $searchMail = $mail->getMailInfo($search, $sender, $addressee);
                $tracking = "";
                //проверяем не присвоен ли отправлению статус удален
                if ($searchMail['1']['statusMail'] != "Удалено") {
                    $searchStatus = $mail->getStatusMail();
                    $i = 1;
                    foreach ($searchStatus as $value) {
                        $tracking .= "<tr>
                <td>$i</td>
                <td>{$value['status_value']}</td>
                <td>{$value['time_acceptance']}</td>
            </tr>";
                        $i++;
                    }
                    $table = <<<_TABLE
<table>
    <tr>
        <th></th>
        <th>ШИ</th>
        <td>{$mail->numberId}</td>
    </tr>
    <tr>
        <th></th>
        <th>Получатель</th>
        <td>{$searchMail['1']['addressee']}</td>
    </tr>
    <tr>
        <th></th>
        <th>Отправитель</th>
        <td>{$searchMail['1']['sender']}</td>
    </tr>
    <tr>
        <th>№</th>
        <th>Статус</th>
        <th>Время регистрации</th>
    </tr>
    $tracking
</table>
_TABLE;
                    $text = $table;
                } else {
                    $text = $mail->numberId . "не найден";
                }
            } else {
                $text = "ID введен не правильно";
            }
        }
        $result = compact('text');
        $this->view->page = "trackingMails/tracking_mails.php";
        $this->view->render($result);
    }

}