// validation.test.js

// Import the functions to be tested
const { isValidEmail } = require('../src/validation');

// Test suite for form validation
describe('Form Validation', () => {
  // Test case for isValidEmail function
  test('isValidEmail returns true for valid email format', () => {
    expect(isValidEmail('test@example.com')).toBe(true);
  });

  // Another test case for isValidEmail function
  test('isValidEmail returns false for invalid email format', () => {
    expect(isValidEmail('invalid-email')).toBe(false);
  });
});
