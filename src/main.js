import { createApp } from 'vue'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'bootstrap-icons/font/bootstrap-icons.min.css'
import './style.css'
import 'vue-loading-overlay/dist/css/index.css'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'
import VueDOMPurifyHTML from 'vue-dompurify-html'

const pinia = createPinia()

createApp(App)
.use(router)
.use(VueDOMPurifyHTML)
.use(pinia)
.mount('#app')
