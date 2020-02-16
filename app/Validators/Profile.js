'use strict'

class Profile {
  get sanitizationRules() {
    return {
      name: 'escape|trim',
      father_name: 'escape|trim',
      mother_name: 'escape|trim',
      birthplace: 'escape|trim',
      height: 'escape|trim',
      current_city: 'escape|trim',
      vatan: 'escape|trim',
      gotra: 'escape|trim',
      rashi: 'escape|trim',
      nadi: 'escape|trim',
      nakshtra: 'escape|trim',
      permanent_address: 'escape|trim',
      education: 'escape|trim',
      hobbies: 'escape|trim',
      job_description: 'escape|trim',
      secondary_address: 'escape|trim',
      references: 'escape|trim'
    }
  }
}

module.exports = Profile
