import axios from 'axios';
import { initScrollSpy } from './nav-scroll'; // Pastikan path-nya benar

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Jalankan fungsinya
document.addEventListener('DOMContentLoaded', () => {
    initScrollSpy();
});