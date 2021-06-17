import { HttpContextContract } from '@ioc:Adonis/Core/HttpContext'
import User from 'App/Models/User'

export default class AuthController {
  public async index(ctx: HttpContextContract) {
    return ctx.view.render('pages/login')
  }

  public async login(ctx: HttpContextContract) {
    const email: string = ctx.request.input('email')
    const password: string = ctx.request.input('password')
    try {
      const user: User = await ctx.auth.use('web').attempt(email, password)
      const canLogin: boolean = await user.canLogin()
      if (canLogin) {
        return ctx.response.redirect('home')
      }
      // not allowed until admin approves it
      await ctx.auth.logout()
      return ctx.response.redirect('back')
    } catch (e) {
      return ctx.response.redirect('back')
    }
  }
}
