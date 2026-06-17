/**
 * Silver Liquid Dev theme scripts.
 * - Dark/light toggle (persisted in localStorage)
 * - Mobile navigation
 * - Copy buttons on code blocks
 */
(function () {
	'use strict';

	var labels = window.silverLiquidDev || { copy: 'Copy', copied: 'Copied' };

	/* ---- Theme toggle ---- */
	var root = document.documentElement;
	var toggle = document.querySelector('.theme-toggle');

	function applyTheme(theme) {
		root.setAttribute('data-theme', theme);
		try { localStorage.setItem('silver-liquid-dev-theme', theme); } catch (e) {}
	}

	if (toggle) {
		toggle.addEventListener('click', function () {
			var current = root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
			applyTheme(current === 'dark' ? 'light' : 'dark');
		});
	}

	/* ---- Mobile nav ---- */
	var navToggle = document.querySelector('.nav-toggle');
	var primaryNav = document.getElementById('primary-nav');

	if (navToggle && primaryNav) {
		var openIcon = navToggle.querySelector('.open-icon');
		var closeIcon = navToggle.querySelector('.close-icon');

		function setNav(open) {
			primaryNav.classList.toggle('open', open);
			navToggle.setAttribute('aria-expanded', String(open));
			if (openIcon) openIcon.hidden = open;
			if (closeIcon) closeIcon.hidden = !open;
		}

		navToggle.addEventListener('click', function () {
			setNav(!primaryNav.classList.contains('open'));
		});

		primaryNav.addEventListener('click', function (e) {
			if (e.target.closest('a')) setNav(false);
		});

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') setNav(false);
		});
	}

	/* ---- Copy buttons on code blocks ---- */
	var copyIcon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>';

	document.querySelectorAll('.prose pre').forEach(function (pre) {
		if (pre.querySelector('.code-copy')) return;

		var btn = document.createElement('button');
		btn.type = 'button';
		btn.className = 'code-copy';
		btn.innerHTML = copyIcon + '<span>' + labels.copy + '</span>';

		btn.addEventListener('click', function () {
			var code = pre.querySelector('code');
			var text = code ? code.innerText : pre.innerText;
			text = text.replace(/\n$/, '');

			var done = function () {
				btn.classList.add('copied');
				btn.querySelector('span').textContent = labels.copied;
				setTimeout(function () {
					btn.classList.remove('copied');
					btn.querySelector('span').textContent = labels.copy;
				}, 1600);
			};

			if (navigator.clipboard && navigator.clipboard.writeText) {
				navigator.clipboard.writeText(text).then(done).catch(function () {
					fallbackCopy(text, done);
				});
			} else {
				fallbackCopy(text, done);
			}
		});

		pre.appendChild(btn);
	});

	function fallbackCopy(text, cb) {
		var ta = document.createElement('textarea');
		ta.value = text;
		ta.style.position = 'fixed';
		ta.style.opacity = '0';
		document.body.appendChild(ta);
		ta.select();
		try { document.execCommand('copy'); cb(); } catch (e) {}
		document.body.removeChild(ta);
	}
})();
