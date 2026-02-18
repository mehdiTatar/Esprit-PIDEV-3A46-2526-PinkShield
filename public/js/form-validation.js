/**
 * AJAX Form Validation System
 * Validates form fields dynamically using AJAX
 * Backend validators (Symfony) enforce actual constraints on submission
 */

document.addEventListener('DOMContentLoaded', function() {
    // Hide all Symfony default error messages first
    const symfonyErrors = document.querySelectorAll('.form-text.text-danger, .invalid-feedback:not(.ajax-error)');
    symfonyErrors.forEach(err => err.style.display = 'none');
    
    // Initialize validation for all form fields with data-validate attribute
    const validateFields = document.querySelectorAll('[data-validate]');
    
    validateFields.forEach(field => {
        // Add event listeners for real-time validation
        field.addEventListener('blur', function() {
            validateField(this);
        });
        
        field.addEventListener('change', function() {
            validateField(this);
        });
        
        // For text inputs, validate on input to show feedback
        if (field.tagName === 'INPUT' || field.tagName === 'TEXTAREA') {
            field.addEventListener('input', function() {
                // Debounce validation on input
                clearTimeout(this.validationTimeout);
                this.validationTimeout = setTimeout(() => {
                    validateField(this);
                }, 500);
            });
        }
    });
    
    // Validate form on submit - show AJAX feedback before real submission
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            validateForm(this);
            // Allow form to submit so backend validators can do final check
            // Backend will return errors if validation fails
        });
    });
});

/**
 * Validate a single field using AJAX
 */
function validateField(field) {
    const validateType = field.getAttribute('data-validate');
    const value = field.value.trim();
    const fieldName = field.name;
    const errorContainer = getErrorContainer(field);
    
    // Clear previous error
    clearError(field, errorContainer);
    
    // Skip validation if field is empty
    if (!value) {
        return true;
    }
    
    // Perform validation based on type
    let errors = [];
    
    switch(validateType) {
        case 'email':
            errors = validateEmail(value, fieldName);
            break;
        case 'name':
            errors = validateName(value, fieldName);
            break;
        case 'address':
            errors = validateAddress(value, fieldName);
            break;
        case 'phone':
            errors = validatePhone(value, fieldName);
            break;
        case 'password':
            errors = validatePassword(value, fieldName, field);
            break;
        case 'product-name':
            errors = validateProductName(value, fieldName);
            break;
        case 'description':
            errors = validateDescription(value, fieldName);
            break;
        case 'comment':
            errors = validateComment(value, fieldName);
            break;
        case 'notes':
            errors = validateNotes(value, fieldName);
            break;
        default:
            errors = validateGeneric(value, fieldName, field);
    }
    
    // Display errors if any
    if (errors.length > 0) {
        showError(field, errorContainer, errors[0]);
        return false;
    }
    
    return true;
}

/**
 * Validate entire form
 */
function validateForm(form) {
    let isValid = true;
    const fields = form.querySelectorAll('[data-validate]');
    
    fields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });
    
    return isValid;
}

// Validation functions
function validateEmail(value, fieldName) {
    const errors = [];
    
    if (value.length > 180) {
        errors.push('Email must not exceed 180 characters');
        return errors;
    }
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(value)) {
        errors.push('Invalid email format');
    }
    
    return errors;
}

function validateName(value, fieldName) {
    const errors = [];
    
    if (value.length < 2) {
        errors.push('must be at least 2 characters');
        return errors;
    }
    
    if (value.length > 100) {
        errors.push('must not exceed 100 characters');
        return errors;
    }
    
    const nameRegex = /^[a-zA-ZÀ-ÿ\s\-']+$/;
    if (!nameRegex.test(value)) {
        errors.push('can only contain letters, spaces, hyphens and apostrophes');
    }
    
    return errors;
}

function validateAddress(value, fieldName) {
    const errors = [];
    
    if (value.length < 2) {
        errors.push('must be at least 2 characters');
        return errors;
    }
    
    if (value.length > 255) {
        errors.push('must not exceed 255 characters');
    }
    
    return errors;
}

function validatePhone(value, fieldName) {
    const errors = [];
    
    if (value.length > 20) {
        errors.push('must not exceed 20 characters');
        return errors;
    }
    
    const phoneRegex = /^[\d\+\-\(\)\s]*$/;
    if (!phoneRegex.test(value)) {
        errors.push('Invalid phone number format');
    }
    
    return errors;
}

function validatePassword(value, fieldName, field) {
    const errors = [];
    
    if (value && value.length < 6) {
        errors.push('must be at least 6 characters');
    }
    
    return errors;
}

function validateProductName(value, fieldName) {
    const errors = [];
    
    if (value.length < 2) {
        errors.push('must be at least 2 characters');
        return errors;
    }
    
    if (value.length > 150) {
        errors.push('must not exceed 150 characters');
    }
    
    return errors;
}

function validateDescription(value, fieldName) {
    const errors = [];
    
    if (value && value.length > 1000) {
        errors.push('cannot exceed 1000 characters');
    }
    
    return errors;
}

function validateComment(value, fieldName) {
    const errors = [];
    
    if (value && value.length > 1000) {
        errors.push('cannot exceed 1000 characters');
    }
    
    return errors;
}

function validateNotes(value, fieldName) {
    const errors = [];
    
    if (value && value.length > 1000) {
        errors.push('cannot exceed 1000 characters');
    }
    
    return errors;
}

function validateGeneric(value, fieldName, field) {
    const errors = [];
    return errors;
}

// Error display helpers
function getErrorContainer(field) {
    let container = field.parentElement.querySelector('.ajax-error');
    if (!container) {
        container = document.createElement('div');
        container.className = 'ajax-error';
        container.style.color = '#dc3545';
        container.style.fontSize = '0.875em';
        container.style.marginTop = '0.25rem';
        field.parentElement.appendChild(container);
    }
    return container;
}

function showError(field, container, message) {
    field.classList.add('is-invalid');
    field.classList.remove('is-valid');
    container.textContent = message;
    container.classList.add('d-block');
    container.style.display = 'block';
}

function clearError(field, container) {
    field.classList.remove('is-invalid');
    field.classList.add('is-valid');
    container.textContent = '';
    container.classList.remove('d-block');
    container.style.display = 'none';
}
