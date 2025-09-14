<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Terms & Conditions</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('navbar')

  <main class="container py-4">
    <h1 class="mb-3">Terms & Conditions</h1>
    <p class="text-muted">Last updated: {{ now()->toDateString() }}</p>

    <section class="mb-4">
      <h5>1. Introduction</h5>
      <p>
        Welcome to <strong>Event Finder</strong>. These Terms & Conditions that govern your access to 
        and use of our event discovery and booking platform (the "App"). 
      </p>
      <p>
        By using our App, you agree to be bound by these Terms. If you do not agree, you must discontinue using the App.
      </p>
    </section>


    <section class="mb-4">
      <h5>3. Accounts</h5>
      <ul>
        <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
        <li>All activity that occurs under your account is your responsibility.</li>
        <li>You must notify us immediately of any unauthorized access or security breach.</li>
        <li>We reserve the right to suspend or terminate accounts at our discretion for violations of these Terms.</li>
      </ul>
    </section>

    <section class="mb-4">
      <h5>4. Event Listings and Bookings</h5>
      <p>
        Event Finder serves as a platform for connecting event organisers with attendees. 
        We do not own, manage, or control the events listed on the website.
      </p>
      <ul>
        <li><strong>Organisers</strong> are responsible for event details, pricing, and compliance with applicable laws.</li>
        <li><strong>Attendees</strong> are responsible for reviewing event information before booking.</li>
        <li>By booking, you agree to the specific terms and cancellation policies set by the event organiser.</li>
      </ul>
    </section>



    <section class="mb-4">
      <h5>6. User Conduct</h5>
      <p>
        You agree not to use the App for any unlawful or prohibited activities, including:
      </p>
      <ul>
        <li>Posting false, misleading, or harmful information about events.</li>
        <li>Interfering with the operation of the App or attempting unauthorized access.</li>
        <li>Violating intellectual property rights of others.</li>
      </ul>
    </section>

    <section class="mb-4">
      <h5>7. Intellectual Property</h5>
      <p>
        All content, design, and features of the App (excluding event content provided by organisers) 
        are owned by Event Finder or its licensors. You may not reproduce, modify, or distribute our content without permission.
      </p>
    </section>

    <section class="mb-4">
      <h5>8. Limitation of Liability</h5>
      <p>
        To the maximum extent permitted by law:
      </p>
      <ul>
        <li>The App is provided on an "as-is" and "as-available" basis.</li>
        <li>We make no guarantees regarding the accuracy or availability of event listings.</li>
        <li>We are not responsible for losses, damages, or disputes between attendees and organisers.</li>
      </ul>
    </section>

    <section class="mb-4">
      <h5>9. Changes to These Terms</h5>
      <p>
        We may update these Terms periodically. The "Last Updated" date at the top of this page will be revised accordingly. 
        Continued use of the App after changes indicates acceptance of the updated Terms.
      </p>
    </section>

    <section class="mb-4">
      <h5>10. Governing Law</h5>
      <p>
        These Terms are governed by the laws of [Your Country/State], without regard to conflict of law principles.
      </p>
    </section>

    <section class="mb-4">
      <h5>11. Contact Us</h5>
      <p>
        If you have questions about these Terms or need support, please contact us:
      </p>
      <ul>
        <li>Email: <a href="mailto:eventfinder@example.com">eventfinder@example.com</a></li>
        <li>Phone: [Insert phone number]</li>
        <li>Address: [Insert business address]</li>
      </ul>
    </section>
    <p>This Privacy policy is written by AI with human review.</p>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
