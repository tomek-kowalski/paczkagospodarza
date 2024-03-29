/*
 * helper function to delay after a promise
 * @param ms
 * @returns {function(*): Promise<unknown>}
 */
const getAnchor = (level) => {
        let url = window.location.href;
        if ( url.indexOf('#') === -1) {
            return false;
        }

       let queryString = url.split('#');
        if ( queryString.length === 1) {
            return false;
        }

        let urlPart = queryString[1];

        //for submenu, we have to get the string after the slash.
        if ( level === 'menu' ) {
			//strip off query variable if present
			if ( urlPart.indexOf('&') !== -1) {
				urlPart = urlPart.split('&')[0];
			}
			//if there is no slash, there is no menu level
            if ( urlPart.indexOf('/') === -1 ) {
                return false;
            } else {
				let urlParts = urlPart.split('/');
                if (urlParts.length<=1) {
                    return false;
                } else {
					return urlParts[1];
                }
            }
        } else {
            //main, just get the first.
            if ( urlPart.indexOf('/') === -1 ) {
                return urlPart;
            } else {
                let urlParts = urlPart.split('/');
               return urlParts[0];
            }
        }
}
export default getAnchor;
