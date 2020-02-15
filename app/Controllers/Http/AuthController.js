'use strict'

class AuthController {

  index({ view }) {
    return view.render('pages.login')
  }

  async login({ auth, request, response, session }) {
    const { email, password } = request.all()
    try {
      const user = await auth.attempt(email, password)
      const canLogin = await user.canLogin()
      if (canLogin) {
        return response.redirect('home')
      } else {
        // not allowed until admin approves it
        await auth.logout()
        session.flashExcept(['password'])
        session.flash({
          message: 'Your registration is not yet approved. ' +
            'Please contact Administrator for approval.'
        })
        return response.redirect('back')
      }
    } catch (e) {
      session.flashExcept(['password'])
      session.flash({ message: 'Your username or password is incorrect' })
      return response.redirect('back')
    }
  }

  async logout({ auth, response }) {
    await auth.logout()
    return response.redirect('login')
  }

}

module.exports = AuthController
