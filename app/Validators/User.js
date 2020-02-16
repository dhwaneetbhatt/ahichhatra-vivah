'use strict'

class User {
  get rules() {
    return {
      'name': 'required|min:2',
      'gender': 'required|in:male,female',
      'email': 'required|email|unique:users,email',
      'primary_number': 'required',
      'birthdate': 'required|date',
      'password': 'required|min:6|max:64|confirmed',
      'password_confirmation': 'required'
    }
  }

  get messages() {
    return {
      'name.required': 'You must provide a name.',
      'name.min': 'Name must be minimum 2 characters.',
      'gender': 'Please select a valid gender.',
      'primary_number': 'You must provide a phone number.',
      'birthdate': 'You must provide a valid birthdate.',
      'email.required': 'You must provide a email address.',
      'email.email': 'You must provide a valid email address.',
      'email.unique': 'This email is already registered.',
      'password.required': 'You must provide a password.',
      'password.min': 'Password must be between 6 and 64 characters.',
      'password.max': 'Password must be between 6 and 64 characters.',
      'password.confirmed': 'Password does not match with Confirm Password.'
    }
  }

  get sanitizationRules() {
    return {
      name: 'escape|trim',
      email: 'email|trim'
    }
  }
}

module.exports = User
