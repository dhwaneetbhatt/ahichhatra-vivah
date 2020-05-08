'use strict'

class Profile {
  get sanitizationRules() {
    return {
      name: 'trim',
      father_name: 'trim',
      mother_name: 'trim',
      birthplace: 'trim',
      height: 'trim',
      current_city: 'trim',
      vatan: 'trim',
      gotra: 'trim',
      rashi: 'trim',
      nadi: 'trim',
      nakshtra: 'trim',
      permanent_address: 'trim',
      education: 'trim',
      hobbies: 'trim',
      job_description: 'trim',
      secondary_address: 'trim',
      references: 'trim'
    }
  }
}

module.exports = Profile
