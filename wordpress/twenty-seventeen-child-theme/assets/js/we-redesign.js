/*
 * Williams Excavations - redesign behaviour
 *
 * Sticky header, scroll reveals, counters, mobile drawer, testimonial
 * slider, hero parallax and the guide read more toggle.
 *
 * Form handling is intentionally absent: Contact Form 7 owns submission.
 */
(function(){
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- sticky header + scroll progress + floating buttons ---------- */
  var header   = document.getElementById('we-siteHeader');
  var progress = document.getElementById('we-progress');
  var toTop    = document.getElementById('we-toTop');
  var callNow  = document.getElementById('we-callNow');
  var ticking  = false;

  function onScroll(){
    var y = window.pageYOffset || document.documentElement.scrollTop;
    var max = document.documentElement.scrollHeight - window.innerHeight;

    header.classList.toggle('we-is-stuck', y > 60);
    progress.style.width = (max > 0 ? (y / max) * 100 : 0) + '%';
    toTop.classList.toggle('we-show', y > 520);
    callNow.classList.toggle('we-show', y > 260);
    ticking = false;
  }
  window.addEventListener('scroll', function(){
    if(!ticking){ window.requestAnimationFrame(onScroll); ticking = true; }
  }, {passive:true});
  onScroll();

  toTop.addEventListener('click', function(){
    window.scrollTo({top:0, behavior: reduce ? 'auto' : 'smooth'});
  });

  /* ---------- mobile drawer ---------- */
  var burger = document.getElementById('we-burger');
  var drawer = document.getElementById('we-navDrawer');
  var scrim  = document.getElementById('we-navScrim');
  var close  = document.getElementById('we-drawerClose');

  function setNav(open){
    document.body.classList.toggle('we-nav-open', open);
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
  }
  burger.addEventListener('click', function(){ setNav(!document.body.classList.contains('we-nav-open')); });
  close.addEventListener('click', function(){ setNav(false); });
  scrim.addEventListener('click', function(){ setNav(false); });
  document.addEventListener('keydown', function(e){ if(e.key === 'Escape') setNav(false); });

  /* drawer submenu accordions */
  Array.prototype.forEach.call(drawer.querySelectorAll('.we-sub-toggle'), function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      btn.closest('li').classList.toggle('we-open');
    });
  });

  /* close the drawer when an in page link is tapped */
  Array.prototype.forEach.call(drawer.querySelectorAll('a[href^="#"]'), function(a){
    a.addEventListener('click', function(){ setNav(false); });
  });

  /* ---------- reveal on scroll ---------- */
  var reveals = document.querySelectorAll('[data-reveal]');
  if('IntersectionObserver' in window && !reduce){
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          var siblings = entry.target.parentElement
            ? Array.prototype.indexOf.call(entry.target.parentElement.children, entry.target)
            : 0;
          entry.target.style.transitionDelay = Math.min(siblings, 6) * 0.09 + 's';
          entry.target.classList.add('we-in');
          io.unobserve(entry.target);
        }
      });
    }, {threshold:0.14, rootMargin:'0px 0px -60px 0px'});
    Array.prototype.forEach.call(reveals, function(el){ io.observe(el); });
  } else {
    Array.prototype.forEach.call(reveals, function(el){ el.classList.add('we-in'); });
  }

  /* ---------- animated counters ---------- */
  var counters = document.querySelectorAll('.we-count');
  function runCount(el){
    var target = parseFloat(el.getAttribute('data-to'));
    var dec = parseInt(el.getAttribute('data-dec') || '0', 10);
    if(reduce){ el.textContent = target.toFixed(dec); return; }
    var start = null, dur = 1600;
    function tick(ts){
      if(!start) start = ts;
      var p = Math.min((ts - start) / dur, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = (target * eased).toFixed(dec);
      if(p < 1) window.requestAnimationFrame(tick);
      else el.textContent = target.toFixed(dec);
    }
    window.requestAnimationFrame(tick);
  }
  if('IntersectionObserver' in window){
    var cio = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){ runCount(entry.target); cio.unobserve(entry.target); }
      });
    }, {threshold:0.5});
    Array.prototype.forEach.call(counters, function(el){ cio.observe(el); });
  } else {
    Array.prototype.forEach.call(counters, runCount);
  }

  /* ---------- testimonial slider ---------- */
  var track = document.getElementById('we-reviewTrack');
  var dotsBox = document.getElementById('we-reviewDots');
  if(track && dotsBox){
    var slides = track.querySelectorAll('.we-review');
    var index = 0, timer = null, sizeRaf = null;

    /* every slide is absolutely positioned, so the track is sized to the tallest one */
    function sizeTrack(){
      var max = 0;
      Array.prototype.forEach.call(slides, function(sl){
        var prev = sl.getAttribute('style') || '';
        sl.setAttribute('style', 'position:static;visibility:hidden;opacity:0;transform:none;transition:none;');
        max = Math.max(max, sl.offsetHeight);
        sl.setAttribute('style', prev);
      });
      track.style.minHeight = max + 'px';
    }
    sizeTrack();
    if(document.fonts && document.fonts.ready) document.fonts.ready.then(sizeTrack);
    window.addEventListener('resize', function(){
      window.cancelAnimationFrame(sizeRaf);
      sizeRaf = window.requestAnimationFrame(sizeTrack);
    });

    Array.prototype.forEach.call(slides, function(_, i){
      var b = document.createElement('button');
      b.type = 'button';
      b.setAttribute('aria-label', 'Show review ' + (i + 1));
      if(i === 0) b.classList.add('we-is-active');
      b.addEventListener('click', function(){ go(i); restart(); });
      dotsBox.appendChild(b);
    });
    var dots = dotsBox.querySelectorAll('button');

    function go(i){
      slides[index].classList.remove('we-is-active');
      dots[index].classList.remove('we-is-active');
      index = (i + slides.length) % slides.length;
      slides[index].classList.add('we-is-active');
      dots[index].classList.add('we-is-active');
    }
    function restart(){
      if(reduce) return;
      window.clearInterval(timer);
      timer = window.setInterval(function(){ go(index + 1); }, 6500);
    }
    restart();
    track.addEventListener('mouseenter', function(){ window.clearInterval(timer); });
    track.addEventListener('mouseleave', restart);
  }

  /* ---------- hero parallax ---------- */
  var heroImg = document.querySelector('.we-hero__bg img');
  if(heroImg && !reduce && window.innerWidth > 860){
    window.addEventListener('scroll', function(){
      var y = window.pageYOffset;
      if(y < window.innerHeight * 1.2){
        heroImg.style.transform = 'scale(1.05) translate3d(0,' + (y * 0.16) + 'px,0)';
      }
    }, {passive:true});
  }

  /* ---------- smooth in page anchors with header offset ---------- */
  Array.prototype.forEach.call(document.querySelectorAll('a[href^="#"]'), function(a){
    a.addEventListener('click', function(e){
      var id = a.getAttribute('href');
      if(id.length < 2) return;
      var t = document.querySelector(id);
      if(!t) return;
      e.preventDefault();
      var offset = document.querySelector('.we-headbar').offsetHeight + 12;
      window.scrollTo({
        top: t.getBoundingClientRect().top + window.pageYOffset - offset,
        behavior: reduce ? 'auto' : 'smooth'
      });
    });
  });

  /* ---------- read more toggle on the guide intro ---------- */
  var moreBtn = document.getElementById('we-introToggle');
  var moreBox = document.getElementById('we-introMore');
  if(moreBtn && moreBox){
    var moreOpen = false;

    function setMore(open){
      moreOpen = open;
      moreBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
      moreBox.setAttribute('aria-hidden', open ? 'false' : 'true');
      moreBox.classList.toggle('we-is-open', open);
      moreBtn.querySelector('.we-read-more__label').textContent = open ? 'Read Less' : 'Read More';

      if(reduce){
        moreBox.style.maxHeight = open ? 'none' : '0px';
        return;
      }
      if(open){
        moreBox.style.maxHeight = moreBox.scrollHeight + 'px';
        moreBox.addEventListener('transitionend', function done(e){
          if(e.propertyName === 'max-height' && moreOpen){ moreBox.style.maxHeight = 'none'; }
          moreBox.removeEventListener('transitionend', done);
        });
      } else {
        moreBox.style.maxHeight = moreBox.scrollHeight + 'px';
        window.requestAnimationFrame(function(){
          window.requestAnimationFrame(function(){ moreBox.style.maxHeight = '0px'; });
        });
      }
    }

    moreBtn.addEventListener('click', function(){ setMore(!moreOpen); });

    /* keep the open panel the right height when the text reflows */
    window.addEventListener('resize', function(){
      if(moreOpen && !reduce) moreBox.style.maxHeight = 'none';
    });
  }


})();
