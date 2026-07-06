import './bootstrap';
import { initScrollSpy } from './nav-scroll';
import { initPasswordToggles } from './password-toggle';

document.addEventListener('DOMContentLoaded', () => {
    initScrollSpy();
    initPasswordToggles();
});
