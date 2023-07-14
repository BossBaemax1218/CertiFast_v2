<?php
$receiving_email_address = 'barangaylosamigos.certifast@gmail.com';

if (file_exists($php_email_form = '../assets/vendor/php-email-form/validate.js')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

class PHP_Email_Form
{
    public $ajax = false; // Disable AJAX
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $smtp = array();

    private $error_message;
    private $email_body;

    public function add_message($message, $label = '', $length = 0)
    {
        if ($length > 0 && strlen($message) > $length) {
            $message = substr($message, 0, $length);
        }
        $this->email_body .= $label . ': ' . $message . "\n";
    }

    public function send()
    {
        if (empty($this->to) || empty($this->from_name) || empty($this->from_email) || empty($this->subject)) {
            $this->error_message = 'Missing required field(s).';
            return $this->error_message;
        }

        $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $this->from_email . "\r\n";
        $headers .= 'Content-Type: text/plain; charset=UTF-8' . "\r\n";

        $this->email_body .= 'IP: ' . $_SERVER['REMOTE_ADDR'] . "\n";
        $this->email_body .= 'User Agent: ' . $_SERVER['HTTP_USER_AGENT'] . "\n";
        $this->email_body .= '---' . "\n";
        $this->email_body .= 'This email was sent via the PHP Email Form.' . "\n";

        try {
            if (!empty($this->smtp['host']) && !empty($this->smtp['username']) && !empty($this->smtp['password']) && !empty($this->smtp['port'])) {
                ini_set('SMTP', $this->smtp['host']);
                ini_set('smtp_port', $this->smtp['port']);
                ini_set('sendmail_from', $this->from_email);

                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
                $headers .= 'X-Mailer: PHP/' . phpversion();

                $success = mail($this->to, $this->subject, $this->email_body, $headers, '-f' . $this->from_email);
            } else {
                $success = mail($this->to, $this->subject, $this->email_body, $headers);
            }

            if ($success) {
                return 'OK';
            } else {
                $this->error_message = 'Failed to send email.';
                return $this->error_message;
            }
        } catch (Exception $e) {
            $this->error_message = $e->getMessage();
            return $this->error_message;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact = new PHP_Email_Form();
    $contact->ajax = false; // Disable AJAX

    $contact->to = $receiving_email_address;
    $contact->from_name = $_POST['name'];
    $contact->from_email = $_POST['email'];
    $contact->subject = $_POST['subject'];

    $contact->smtp = array(
        'host' => 'smtp.gmail.com',
        'username' => 'barangaylosamigos.certifast@gmail.com',
        'password' => 'ipqostilxutxmbxl',
        'port' => '587'
    );

    $contact->add_message($_POST['name'], 'From');
    $contact->add_message($_POST['email'], 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);

    echo $contact->send();
}

?>
