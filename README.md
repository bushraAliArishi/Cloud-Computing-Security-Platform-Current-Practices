# Cloud Computing Security Platform: Current Practices

This repository contains the implementation and documentation of a secure cloud computing framework proposed as part of a graduation project. The solution addresses key security concerns in cloud environments by integrating a Trusted Third Party (TTP) and advanced encryption mechanisms.

## Overview

Cloud computing introduces efficiency and flexibility, but also exposes systems to critical security risks including data breaches, unauthorized access, and lack of user trust. This project presents a system that ensures data confidentiality, integrity, and authentication through layered security techniques.

## Problem Statement

Cloud data is inherently vulnerable to various threats:
- Users lack visibility and control over how data is stored or accessed.
- Trust between cloud providers and users is often insufficient.
- Traditional protection mechanisms are not enough for dynamic cloud environments.

## Proposed Solution

The system introduces a **Trusted Third Party (TTP)** which operates alongside cloud services to enforce security policies. Key components:
- Authentication through local server login.
- Role-based access control.
- Data encryption using AES, RSA, and DES.
- Policy verification before transmission to the cloud.
- Acknowledgment and fallback mechanisms upon policy mismatch.

## System Features

- 🔐 Secure login and identity validation.
- 📥 Encrypted file upload & download.
- 🧾 Logging of feedback and activity.
- 🧠 Integration with PKI, SSO, and LDAP.
- ⚙️ Compatibility with Microsoft Azure and Python-based backend.
- 📦 Backup and recovery support using WD My Cloud Home device.

## Architecture

The system is divided into:
- **Client Side**: User interface for authentication and file interactions.
- **Server Side**: Handles authentication, encryption, policy checks.
- **Cloud Backend**: Microsoft Azure for hosting and data storage.
- **Security Layer**: TTP responsible for cryptographic integrity and trust establishment.

## Functional Requirements

- User registration, login, and session management.
- File upload/download with encryption.
- Feedback submission and retrieval.
- Access control based on roles.

## Non-Functional Requirements

- **Usability**: Suitable for all user levels with intuitive design.
- **Backup**: Ensures data availability and recovery.
- **Integrity**: Guarantees that data is not modified during transfer.

## Technology Stack

- Programming: **Python**
- Cloud Provider: **Microsoft Azure**
- Hardware Integration: **WD My Cloud Home**
- Cryptography: **AES, RSA, DES**

## How to Run

1. Clone this repository.
2. Set up a Python environment and install required packages.
3. Configure your Azure environment and credentials.
4. Run the local server and simulate user interactions.
5. Use the provided scripts to test upload, encryption, and feedback features.

---
<p align="center">
  <a href="https://www.linkedin.com/in/bushraAliArishi">
    <kbd style="font-size:16px;">Visit my LinkedIn Profile</kbd>
  </a>
</p>
