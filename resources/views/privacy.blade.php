<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Privacy Policy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('navbar')

  <main class="container py-4">
    <h1 class="mb-3">Privacy Policy</h1>
    <p class="text-muted">Last updated: {{ now()->toDateString() }}</p>

    <section class="mb-4">
      <p>
        At <strong>Event Finder</strong> ("we," "our," or "us"), we are committed to protecting your privacy and ensuring
        the ethical handling of personal data. This Privacy Policy explains what data we collect, why we collect it,
        how it is stored and protected, and your rights as a user of our application.
      </p>
      <p>
        By registering for an account, you will be asked to <strong>explicitly agree</strong> to this Privacy Policy
        and our Terms of Use. This agreement is obtained through a required checkbox on the registration form and validated
        server-side to prevent bypassing.
      </p>
    </section>

    <section class="mb-4">
      <h5>1. Information We Collect</h5>
      <p>We only collect data necessary to provide our services effectively:</p>
      <ul>
        <li><strong>Name:</strong> To identify you within the platform.</li>
        <li><strong>Email Address:</strong> For authentication, communication, and account recovery.</li>
        <li><strong>Password:</strong> Secured with strong hashing algorithms for account protection.</li>
        <li><strong>Booking History:</strong> To manage event participation and provide a record of your bookings.</li>
      </ul>
    </section>

    <section class="mb-4">
      <h5>2. Purpose of Data Collection</h5>
      <p>Your data is collected for the following purposes:</p>
      <ul>
        <li>To create and manage your account securely.</li>
        <li>To allow you to register for and participate in events.</li>
        <li>To provide personalized event recommendations.</li>
        <li>To ensure smooth booking management and customer support.</li>
        <li>To comply with legal requirements when necessary.</li>
      </ul>
    </section>

    <section class="mb-4">
      <h5>3. Data Storage and Protection</h5>
      <p>
        We take the security of your data seriously and have implemented strict measures to prevent unauthorized access or misuse:
      </p>
      <ul>
        <li><strong>Hashed Passwords:</strong> All passwords are encrypted using secure hashing algorithms and cannot be viewed by anyone, including our staff.</li>
        <li><strong>Access Control:</strong> Only authorized personnel have access to user data, and access is restricted to necessary functions.</li>
        <li><strong>Secure Servers:</strong> Data is stored on protected servers with regular security updates and backups.</li>
      </ul>
    </section>

    <section class="mb-4">
      <h5>4. Informed Consent</h5>
      <p>
        During registration, users must explicitly provide informed consent by checking a required box stating that they
        agree to this Privacy Policy and our Terms of Use. The checkbox is validated both on the client-side and server-side
        to ensure it cannot be bypassed.
      </p>
      <p>
        If you do not agree to the collection and use of your data as outlined, you may not create an account or use our services.
      </p>
    </section>

    <section class="mb-4">
      <h5>5. Your Rights</h5>
      <p>As a user, you have full control over your data, including the right to:</p>
      <ul>
        <li><strong>View:</strong> Access the data we hold about you through your account settings.</li>
        <li><strong>Manage:</strong> Update or correct your personal details at any time.</li>
        <li><strong>Delete:</strong> Request permanent deletion of your account and associated data.</li>
        <li><strong>Withdraw Consent:</strong> Stop using the platform at any time and revoke permission for us to process your data.</li>
      </ul>
      <p>
        To exercise these rights, please contact us at
        <a href="mailto:eventfinder@example.com">eventfinder@example.com</a>.
      </p>
    </section>

    <section class="mb-4">
      <h5>6. Data Sharing</h5>
      <p>
        We do <strong>not</strong> sell or trade your personal data. We only share information in limited cases:
      </p>
      <ul>
        <li><strong>Event Organizers:</strong> Basic details (e.g., name and email) may be shared to confirm your booking.</li>
        <li><strong>Service Providers:</strong> Trusted third parties who help us process payments and operate the platform, under strict confidentiality agreements.</li>
        <li><strong>Legal Obligations:</strong> When required by law or to protect the rights and safety of our users.</li>
      </ul>
    </section>

    <section class="mb-4">
      <h5>7. Cookies and Tracking</h5>
      <p>
        We use cookies to improve your user experience, such as remembering preferences and tracking site performance.
        You can manage cookie preferences through your browser settings.
      </p>
    </section>

    <section class="mb-4">
      <h5>8. Children’s Privacy</h5>
      <p>
        Our platform is not intended for children under 13 years of age (or the applicable minimum age in your region).
        We do not knowingly collect data from children.
      </p>
    </section>

    <section class="mb-4">
      <h5>9. Changes to This Privacy Policy</h5>
      <p>
        We may update this Privacy Policy periodically. Updates will be posted here, and the "Last Updated" date will reflect
        the most recent changes. Significant changes will be communicated via email or in-app notifications.
      </p>
    </section>

    <section class="mb-4">
      <h5>10. Contact Us</h5>
      <p>
        If you have any questions about this Privacy Policy or our data handling practices, please reach out to us:
      </p>
      <ul>
        <li>Email: <a href="mailto:eventfinder@example.com">eventfinder@example.com</a></li>
        <li>Phone: [012345678]</li>
        <li>Address: [1 Main Street, Anytown, QLD]</li>
      </ul>
    </section>
      <p>This Privacy policy is written by AI with human review.</p>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
