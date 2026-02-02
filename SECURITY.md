# Security Policy

At PetMart, we take the security of our users and their data seriously. This document outlines the security measures and principles implemented within our application to ensure a safe and secure environment.

## 1. Authentication & Authorization

We leverage the robust capabilities of the Laravel ecosystem to manage user identity and access control securely.

*   **Laravel Jetstream:** We use Jetstream for our application scaffolding, which provides a secure, pre-built implementation for login, registration, email verification, two-factor authentication, and session management.
*   **Laravel Sanctum:** API authentication is handled via Laravel Sanctum, issuing secure, revocable tokens for API access. This ensures that only authenticated clients can interact with our protected endpoints.
*   **Policy-Based Access Control:** We utilize Laravel's Authorization features (Policies and Gates) to enforce strict access controls. Every sensitive action (e.g., updating a product, viewing a profile) is authorized against a specific policy to ensure the authenticated user has the necessary permissions.

## 2. Data Integrity

Ensuring the consistency and reliability of our data is paramount.

*   **SQL Transactions:** Critical database operations involving multiple steps (such as order processing) are wrapped in **Database Transactions**. This ensures atomicity—either all operations succeed, or none do—preventing data inconsistency.
*   **Foreign Key Constraints:** We enforce referential integrity at the database level using foreign key constraints. This protects relationships between data entities (e.g., an order must belong to a valid user) and prevents orphaned records.
*   **Prepared Statements:** All database queries are executed using Laravel's Eloquent ORM, which uses PDO parameter binding by default. This approach effectively neutralizes SQL injection attacks by treating user input as data, not executable code.

## 3. Cross-Site Scripting (XSS) & Injection Prevention

We employ multiple layers of defense to protect against injection attacks and cross-site scripting.

*   **Input Sanitization:** We strictly validate and sanitize user inputs. Helper functions like `strip_tags()` are utilized where appropriate to strip unwanted HTML tags from user-submitted content.
*   **Blade Auto-Escaping:** Our frontend views are built with Blade, Laravel's templating engine. Blade automatically escapes output variable data (using `{{ }}` syntax), converting special characters to HTML entities and preventing malicious scripts from executing in the browser.
*   **CSP Headers:** We implement **Content Security Policy (CSP)** headers to restrict the sources from which content (such as scripts and styles) can be loaded. This significantly mitigates the risk of XSS attacks by blocking unauthorized scripts.

## 4. Network Security

We enforce secure communication channels and robust network policies.

*   **Secure Headers:** Our application utilizes the `AddSecurityHeaders` middleware to inject critical security headers into every response. These include `X-Content-Type-Options`, `X-Frame-Options`, and `X-XSS-Protection`, hardening the browser against various client-side attacks.
*   **HTTPS Enforcement:** We enforce **Transport Layer Security (TLS/HTTPS)** for all traffic. In production environments, any attempt to access the application via HTTP is automatically redirected to HTTPS, ensuring that data in transit is encrypted and protected from interception and tampering.

## 5. Audit Trail

To ensure accountability and visibility into security-relevant events, we maintain a comprehensive audit trail.

*   **Security Logging System:** We have implemented a dedicated `SecurityLog` system that automatically records critical security events.
    *   **Login Tracking:** Successful user logins are logged with the user's ID and IP address.
    *   **Failed Attempts:** Failed login attempts are captured, allowing us to detect and respond to brute-force attacks.
    *   **Admin Actions:** Critical administrative actions (such as product deletions) are manually logged using our helper method `SecurityLog::record()`, providing a detailed history of sensitive operations.
