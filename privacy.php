<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .button {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .button:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Terms and Conditions</h1>
        <p>Welcome to our job portal platform. By accessing and using this website, you agree to the following terms and conditions. Please read them carefully.</p>

        <p>We provide access to our job portal platform that connects job seekers with employers. By using our services, you acknowledge and accept these terms.</p>
        
        <p>Your account is your responsibility. You must ensure the confidentiality of your login credentials and prevent unauthorized access to your account.</p>

        <p>The platform is designed to help users build resumes, search for jobs, and apply for job opportunities. All actions carried out on the platform are your responsibility.</p>

        <p>You are required to provide truthful, accurate, and current information while using our services. Providing false information may lead to account suspension or termination.</p>

        <p>You are prohibited from using this platform for any illegal activities or for uploading malicious or harmful content.</p>

        <p>We are not responsible for any job offers, job applications, or other services that may arise as a result of your use of the platform.</p>

        <p>The resume builder tool is provided for your convenience. We do not guarantee that using the tool will lead to successful job placements.</p>

        <p>Any content you upload, including your resume, cover letter, or personal details, is your responsibility, and you grant us permission to store it on our servers.</p>

        <p>We take privacy seriously and comply with all applicable data protection laws. Your personal data will only be used in accordance with our <a href="#">Privacy Policy</a>.</p>

        <p>We reserve the right to update or modify these terms at any time. It is your responsibility to review these terms periodically for any changes.</p>

        <p>If we make any changes to the terms, you will be notified, and your continued use of the platform will constitute acceptance of the updated terms.</p>

        <p>We may suspend or terminate your access to the platform at any time, with or without cause, if we believe you are violating these terms.</p>

        <p>You must not attempt to disrupt the operation of the platform, including hacking or attempting to interfere with our servers or data.</p>

        <p>We may use third-party services to enhance the functionality of the platform. By using the platform, you agree to the terms of these third parties as well.</p>

        <p>You agree not to post any content that is offensive, discriminatory, or violates the rights of others.</p>

        <p>Your access to the platform may be restricted or modified based on your usage or account activity at our discretion.</p>

        <p>You agree that we are not liable for any loss or damage resulting from the use of the platform, including but not limited to errors, downtime, or any defects in the service.</p>

        <p>You are responsible for backing up any data you submit on the platform. We are not responsible for any loss of data.</p>

        <p>The use of the platform is at your own risk. We do not guarantee uninterrupted or error-free access to the platform.</p>

        <p>We are not responsible for any issues arising from third-party applications or job postings made through the platform.</p>

        <p>If you have any issues with our services, please contact our support team for assistance.</p>

        <p>We may collect analytics or feedback from your usage of the platform to improve our services.</p>

        <p>By using the platform, you consent to the use of cookies and similar technologies for tracking usage and improving user experience.</p>

        <p>Any updates to the platform or changes in functionality will be communicated to users. You are expected to comply with any new features introduced.</p>

        <p>We do not guarantee that any content you post will be seen or interacted with by employers or other users.</p>

        <p>We are not liable for any interaction between job seekers and employers, and we do not guarantee employment opportunities.</p>

        <p>We do not endorse any employers or job postings on the platform. Job seekers are responsible for conducting their own research about potential employers.</p>

        <p>We may restrict access to certain features based on account status or usage patterns.</p>

        <p>If you choose to link your account with other platforms, you agree to their terms and conditions as well.</p>

        <p>By creating an account, you agree to allow us to send notifications or promotional emails related to your account.</p>

        <p>We reserve the right to modify or remove any content submitted by users that violates our terms of use.</p>

        <p>Any content you post on the platform must comply with all intellectual property laws and should not infringe on the rights of others.</p>

        <p>We are not responsible for any issues or disputes that arise between users or between users and employers.</p>

        <p>We may offer additional services or premium features that may require a paid subscription. Details will be provided at the time of offering.</p>

        <p>If any part of these terms is found to be invalid or unenforceable, the remaining parts will remain in effect.</p>

        <p>These terms represent the full agreement between you and the platform regarding the use of our services.</p>

        <p>You agree to comply with all applicable laws, including those related to data protection, employment, and intellectual property, when using our platform.</p>

        <p>In case of any dispute, you agree to resolve it through binding arbitration, as outlined in our dispute resolution procedures.</p>

        <p>You may not transfer or assign your rights and obligations under these terms to any other party without our prior written consent.</p>

        <p>By using this platform, you confirm that you have the legal capacity to enter into these terms and conditions.</p>

        <input type="checkbox" id="agreeCheckbox"> 
        <label for="agreeCheckbox">I have read and agree to the Terms and Conditions</label>
        <br><br>
        <button id="proceedButton" class="button" disabled>Proceed</button>
    </div>

    <script>
        document.getElementById("agreeCheckbox").addEventListener("change", function() {
            document.getElementById("proceedButton").disabled = !this.checked;
        });

        document.getElementById("proceedButton").addEventListener("click", function() {
            alert("Thank you for agreeing to the Terms and Conditions!");
            window.location.href = "settings.php"; 
        });
    </script>
</body>
</html>
