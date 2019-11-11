import Token from './Token'
import AppStorage from './AppStorage'



class User {
	reposneAfterLogin(res){
		const access_token = res.data.access_token
		const username = res.data.name
		if (Token.isValid(access_token)) {
			AppStorage.store(access_token, username)
		}
	}
	hasToken(){
		const storedToken = localStorage.getItem('token');
		if (storedToken) {
			return Token.isValid(storedToken) ? true : false
		}
		return false
	}

	loggedIn(){
		return this.hasToken()
	}

	logeOut(){
		AppStorage.clear();
		window.location = '/'
	}

	name(){
		if (this.loggedIn) {
			return localStorage.getItem('user')
		}
	}

	id(){
		if (this.loggedIn) {
			const payload = Token.payload(localStorage.getItem('token')) 
			return payload.sub
		}
		return false
	}
}

export default User = new User()