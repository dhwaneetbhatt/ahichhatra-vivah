'use strict'

class UserController {
  
  async index({ view }) {
    return view.render('pages.login')
  }

}

module.exports = UserController
