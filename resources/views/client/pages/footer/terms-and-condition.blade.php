@extends('client.layouts.client')
@section('content')
<div class="container">
    <h2 class="fw-bold mb-4 text-center">Terms and Conditions</h2>

    <div class="card shadow-sm p-4 border-0">
        <h4 class="fw-bold mb-3">1. Introduction</h4>
        <p>
            Welcome to <strong>MotoSmart AI</strong>. By accessing or using our website and services, you agree to comply with and be bound by these Terms and Conditions.
            Please read them carefully before making any purchase, booking services, or using any feature on this platform.
        </p>

        <h4 class="fw-bold mt-4 mb-3">2. Use of the Platform</h4>
        <p>
            You agree to use MotoSmart AI only for lawful purposes and in accordance with these Terms. You are responsible for maintaining the confidentiality of your account credentials and for all activities under your account.
        </p>

        <h4 class="fw-bold mt-4 mb-3">3. Products and Services</h4>
        <p>
            Our platform offers motorcycle products, accessories, and AI-based maintenance assistance. Product images and descriptions are provided for reference only and may differ slightly from the actual items.
            MotoSmart AI reserves the right to modify, update, or discontinue any product or service at any time without prior notice.
        </p>

        <h4 class="fw-bold mt-4 mb-3">4. Orders and Payments</h4>
        <p>
            By placing an order, you confirm that all information provided is accurate and complete. Once an order is submitted, it is subject to review and approval.
        </p>
        <ul>
            <li>All prices are displayed in PHP (₱).</li>
            <li>Payments can be made via GCash or Cash on Delivery (COD).</li>
            <li>If GCash is used, you must upload a valid screenshot of the payment proof with a unique reference number.</li>
            <li>Orders with invalid or duplicate payment proofs may be canceled.</li>
        </ul>

        <h4 class="fw-bold mt-4 mb-3">5. Shipping and Delivery</h4>
        <p>
            Delivery timelines may vary depending on your location and order type. While we aim to deliver promptly, MotoSmart AI is not liable for delays caused by courier services or external factors beyond our control.
        </p>

        <h4 class="fw-bold mt-4 mb-3">6. Returns, Refunds, and Cancellations</h4>
        <ul>
            <li>Returns are only accepted for defective or incorrect items within 7 days of receipt.</li>
            <li>Refunds will be processed after inspection of the returned item.</li>
            <li>Service bookings cannot be refunded once the appointment has been completed.</li>
        </ul>

        <h4 class="fw-bold mt-4 mb-3">7. Service Appointments</h4>
        <p>
            For maintenance or troubleshooting services, appointment schedules are subject to shop availability.
            Customers are responsible for ensuring accurate motorcycle details and availability at the scheduled time.
        </p>

        <h4 class="fw-bold mt-4 mb-3">8. AI Predictions and Recommendations</h4>
        <p>
            MotoSmart AI provides AI-based predictions and recommendations to assist in preventive maintenance.
            These insights are generated using data models and should not replace professional mechanical assessment.
        </p>

        <h4 class="fw-bold mt-4 mb-3">9. Limitation of Liability</h4>
        <p>
            MotoSmart AI and its affiliates are not liable for any indirect, incidental, or consequential damages arising from the use of our products, services, or platform.
        </p>

        <h4 class="fw-bold mt-4 mb-3">10. Privacy and Data Protection</h4>
        <p>
            We collect and process personal information in accordance with our <a href="{{ route('footer.privacy') }}">Privacy Policy</a>.
            Your data will only be used to process orders, provide services, and improve your MotoSmart AI experience.
        </p>

        <h4 class="fw-bold mt-4 mb-3">11. Changes to These Terms</h4>
        <p>
            MotoSmart AI reserves the right to modify or update these Terms and Conditions at any time. Updates will be effective immediately upon posting on this page.
        </p>

        <h4 class="fw-bold mt-4 mb-3">12. Contact Us</h4>
        <p>
            For any concerns or inquiries, you may contact our support team at <a href="mailto:motosmartteam@gmail.com">motosmartteam@gmail.com</a>.
        </p>

        <p class="mt-5 text-center text-muted">
            By using MotoSmart AI, you acknowledge that you have read, understood, and agreed to these Terms and Conditions.
        </p>
    </div>
</div>
@endsection
