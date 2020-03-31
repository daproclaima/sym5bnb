let $ = require('jquery')
global.$ = global.jquery = $
require('bootstrap')
require('./datepicker.common.js')
require('./datepicker.min.js')
require('./fontawesome.js')
require('@chenfengyuan/datepicker/i18n/datepicker.fr-FR')
const faviconPath = require('../images/favicon_symbol.png');

let html = `<link rel="favicon" href="${faviconPath}" alt="favicon sym5BnB">`
