(function ($, mw) {
  /* Load Google Analytics, user can opt-out */
  const analyticsID = 'G-EXQ0D9LT9H';
  mw.loader.load('https://www.googletagmanager.com/gtag/js?id=' + analyticsID);

  window.dataLayer = window.dataLayer || [];
  function gtag() { dataLayer.push(arguments); }
  gtag('js', new Date());
  gtag('config', analyticsID);

  /* Cookies banner and Google Analytics opt-out */
  const analyticsRejectedCookie = '_analytics_rejected';
  const analyticsDisableProperty = 'ga-disable-' + analyticsID;

  if (mw.cookie.get(analyticsRejectedCookie) == 'true') {
    window[analyticsDisableProperty] = true;
  }
  else if (mw.cookie.get(analyticsRejectedCookie) != 'false') {
    mw.loader.using('oojs-ui-core').done(function() {
      const cookiesDiv = document.createElement('div');
      cookiesDiv.style = 'position: fixed; background-color: rgba(13,17,23,0.8); box-sizing: border-box; padding: 7px 15px; bottom: 0; left: 0; width: 100%; z-index: 1999; display: flex; justify-content: center; flex-wrap: wrap;';

      const textDiv = document.createElement('div');
      textDiv.style = 'display: flex; align-items: center; color: #fff; font-weight: bold; font-size: 92%; margin: 8px;';
      textDiv.innerHTML = '<span>Este sitio usa cookies técnicas para su funcionamiento. Adicionalmente usamos Google Analytics, si quieres puedes rechazarlo. <a style="color: #58a6ff;" href="' + mw.config.get('wgArticlePath').replace('$1', mw.config.get('wgSiteName') + ':Cookies') + '">Leer más</a>.</span>';
      cookiesDiv.append(textDiv);

      const rejectBtn = new OO.ui.ButtonWidget({ label: 'Rechazar' });
      rejectBtn.on('click', function(){
        window[analyticsDisableProperty] = true;
        document.cookie.split(';').forEach(function(c) {
          c = c.trim();
          if (c.startsWith('_ga') || c.startsWith('_gid')) {
            document.cookie = c.split('=')[0] + '=; Path=/; Domain=.' + document.location.host.split('.').slice(-2).join('.') + '; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
          }
        });
        mw.cookie.set(analyticsRejectedCookie, true);
        $(cookiesDiv).detach();
      });

      const acceptBtn = new OO.ui.ButtonWidget({ label: 'Aceptar', flags: ['primary', 'progressive'] });
      acceptBtn.on('click', function(){
        mw.cookie.set(analyticsRejectedCookie, false);
        $(cookiesDiv).detach();
      });

      const layoutB = new OO.ui.HorizontalLayout({ items: [rejectBtn, acceptBtn] });
      $(cookiesDiv).append(layoutB.$element);

      $('body').append(cookiesDiv);
    });
  }
})(jQuery, mediaWiki);
