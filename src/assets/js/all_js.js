function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _wrapNativeSuper(Class) { var _cache = typeof Map === "function" ? new Map() : undefined; _wrapNativeSuper = function _wrapNativeSuper(Class) { if (Class === null || !_isNativeFunction(Class)) return Class; if (typeof Class !== "function") { throw new TypeError("Super expression must either be null or a function"); } if (typeof _cache !== "undefined") { if (_cache.has(Class)) return _cache.get(Class); _cache.set(Class, Wrapper); } function Wrapper() { return _construct(Class, arguments, _getPrototypeOf(this).constructor); } Wrapper.prototype = Object.create(Class.prototype, { constructor: { value: Wrapper, enumerable: false, writable: true, configurable: true } }); return _setPrototypeOf(Wrapper, Class); }; return _wrapNativeSuper(Class); }

function _construct(Parent, args, Class) { if (_isNativeReflectConstruct()) { _construct = Reflect.construct; } else { _construct = function _construct(Parent, args, Class) { var a = [null]; a.push.apply(a, args); var Constructor = Function.bind.apply(Parent, a); var instance = new Constructor(); if (Class) _setPrototypeOf(instance, Class.prototype); return instance; }; } return _construct.apply(null, arguments); }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _isNativeFunction(fn) { return Function.toString.call(fn).indexOf("[native code]") !== -1; }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*! lazysizes - v5.2.0-beta1 */
!function (a, b) {
  var c = b(a, a.document);
  a.lazySizes = c, "object" == (typeof module === "undefined" ? "undefined" : _typeof(module)) && module.exports && (module.exports = c);
}("undefined" != typeof window ? window : {}, function (a, b) {
  "use strict";

  var c, d;
  if (function () {
    var b,
        c = {
      lazyClass: "lazyload",
      loadedClass: "lazyloaded",
      loadingClass: "lazyloading",
      preloadClass: "lazypreload",
      errorClass: "lazyerror",
      autosizesClass: "lazyautosizes",
      srcAttr: "data-src",
      srcsetAttr: "data-srcset",
      sizesAttr: "data-sizes",
      minSize: 40,
      customMedia: {},
      init: !0,
      expFactor: 1.5,
      hFac: .8,
      loadMode: 2,
      loadHidden: !0,
      ricTimeout: 0,
      throttleDelay: 125
    };
    d = a.lazySizesConfig || a.lazysizesConfig || {};

    for (b in c) {
      b in d || (d[b] = c[b]);
    }
  }(), !b || !b.getElementsByClassName) return {
    init: function init() {},
    cfg: d,
    noSupport: !0
  };

  var e = b.documentElement,
      f = a.Date,
      g = a.HTMLPictureElement,
      h = "addEventListener",
      i = "getAttribute",
      j = a[h],
      k = a.setTimeout,
      l = a.requestAnimationFrame || k,
      m = a.requestIdleCallback,
      n = /^picture$/i,
      o = ["load", "error", "lazyincluded", "_lazyloaded"],
      p = {},
      q = Array.prototype.forEach,
      r = function r(a, b) {
    return p[b] || (p[b] = new RegExp("(\\s|^)" + b + "(\\s|$)")), p[b].test(a[i]("class") || "") && p[b];
  },
      s = function s(a, b) {
    r(a, b) || a.setAttribute("class", (a[i]("class") || "").trim() + " " + b);
  },
      t = function t(a, b) {
    var c;
    (c = r(a, b)) && a.setAttribute("class", (a[i]("class") || "").replace(c, " "));
  },
      u = function u(a, b, c) {
    var d = c ? h : "removeEventListener";
    c && u(a, b), o.forEach(function (c) {
      a[d](c, b);
    });
  },
      v = function v(a, d, e, f, g) {
    var h = b.createEvent("Event");
    return e || (e = {}), e.instance = c, h.initEvent(d, !f, !g), h.detail = e, a.dispatchEvent(h), h;
  },
      w = function w(b, c) {
    var e;
    !g && (e = a.picturefill || d.pf) ? (c && c.src && !b[i]("srcset") && b.setAttribute("srcset", c.src), e({
      reevaluate: !0,
      elements: [b]
    })) : c && c.src && (b.src = c.src);
  },
      x = function x(a, b) {
    return (getComputedStyle(a, null) || {})[b];
  },
      y = function y(a, b, c) {
    for (c = c || a.offsetWidth; c < d.minSize && b && !a._lazysizesWidth;) {
      c = b.offsetWidth, b = b.parentNode;
    }

    return c;
  },
      z = function () {
    var a,
        c,
        d = [],
        e = [],
        f = d,
        g = function g() {
      var b = f;

      for (f = d.length ? e : d, a = !0, c = !1; b.length;) {
        b.shift()();
      }

      a = !1;
    },
        h = function h(d, e) {
      a && !e ? d.apply(this, arguments) : (f.push(d), c || (c = !0, (b.hidden ? k : l)(g)));
    };

    return h._lsFlush = g, h;
  }(),
      A = function A(a, b) {
    return b ? function () {
      z(a);
    } : function () {
      var b = this,
          c = arguments;
      z(function () {
        a.apply(b, c);
      });
    };
  },
      B = function B(a) {
    var b,
        c = 0,
        e = d.throttleDelay,
        g = d.ricTimeout,
        h = function h() {
      b = !1, c = f.now(), a();
    },
        i = m && g > 49 ? function () {
      m(h, {
        timeout: g
      }), g !== d.ricTimeout && (g = d.ricTimeout);
    } : A(function () {
      k(h);
    }, !0);

    return function (a) {
      var d;
      (a = !0 === a) && (g = 33), b || (b = !0, d = e - (f.now() - c), d < 0 && (d = 0), a || d < 9 ? i() : k(i, d));
    };
  },
      C = function C(a) {
    var b,
        c,
        d = 99,
        e = function e() {
      b = null, a();
    },
        g = function g() {
      var a = f.now() - c;
      a < d ? k(g, d - a) : (m || e)(e);
    };

    return function () {
      c = f.now(), b || (b = k(g, d));
    };
  },
      D = function () {
    var g,
        m,
        o,
        p,
        y,
        D,
        F,
        G,
        H,
        I,
        J,
        K,
        L = /^img$/i,
        M = /^iframe$/i,
        N = "onscroll" in a && !/(gle|ing)bot/.test(navigator.userAgent),
        O = 0,
        P = 0,
        Q = 0,
        R = -1,
        S = function S(a) {
      Q--, (!a || Q < 0 || !a.target) && (Q = 0);
    },
        T = function T(a) {
      return null == K && (K = "hidden" == x(b.body, "visibility")), K || !("hidden" == x(a.parentNode, "visibility") && "hidden" == x(a, "visibility"));
    },
        U = function U(a, c) {
      var d,
          f = a,
          g = T(a);

      for (G -= c, J += c, H -= c, I += c; g && (f = f.offsetParent) && f != b.body && f != e;) {
        (g = (x(f, "opacity") || 1) > 0) && "visible" != x(f, "overflow") && (d = f.getBoundingClientRect(), g = I > d.left && H < d.right && J > d.top - 1 && G < d.bottom + 1);
      }

      return g;
    },
        V = function V() {
      var a,
          f,
          h,
          j,
          k,
          l,
          n,
          o,
          q,
          r,
          s,
          t,
          u = c.elements;

      if ((p = d.loadMode) && Q < 8 && (a = u.length)) {
        for (f = 0, R++; f < a; f++) {
          if (u[f] && !u[f]._lazyRace) if (!N || c.prematureUnveil && c.prematureUnveil(u[f])) ba(u[f]);else if ((o = u[f][i]("data-expand")) && (l = 1 * o) || (l = P), r || (r = !d.expand || d.expand < 1 ? e.clientHeight > 500 && e.clientWidth > 500 ? 500 : 370 : d.expand, c._defEx = r, s = r * d.expFactor, t = d.hFac, K = null, P < s && Q < 1 && R > 2 && p > 2 && !b.hidden ? (P = s, R = 0) : P = p > 1 && R > 1 && Q < 6 ? r : O), q !== l && (D = innerWidth + l * t, F = innerHeight + l, n = -1 * l, q = l), h = u[f].getBoundingClientRect(), (J = h.bottom) >= n && (G = h.top) <= F && (I = h.right) >= n * t && (H = h.left) <= D && (J || I || H || G) && (d.loadHidden || T(u[f])) && (m && Q < 3 && !o && (p < 3 || R < 4) || U(u[f], l))) {
            if (ba(u[f]), k = !0, Q > 9) break;
          } else !k && m && !j && Q < 4 && R < 4 && p > 2 && (g[0] || d.preloadAfterLoad) && (g[0] || !o && (J || I || H || G || "auto" != u[f][i](d.sizesAttr))) && (j = g[0] || u[f]);
        }

        j && !k && ba(j);
      }
    },
        W = B(V),
        X = function X(a) {
      var b = a.target;
      if (b._lazyCache) return void delete b._lazyCache;
      S(a), s(b, d.loadedClass), t(b, d.loadingClass), u(b, Z), v(b, "lazyloaded");
    },
        Y = A(X),
        Z = function Z(a) {
      Y({
        target: a.target
      });
    },
        $ = function $(a, b) {
      try {
        a.contentWindow.location.replace(b);
      } catch (c) {
        a.src = b;
      }
    },
        _ = function _(a) {
      var b,
          c = a[i](d.srcsetAttr);
      (b = d.customMedia[a[i]("data-media") || a[i]("media")]) && a.setAttribute("media", b), c && a.setAttribute("srcset", c);
    },
        aa = A(function (a, b, c, e, f) {
      var g, h, j, l, m, p;
      (m = v(a, "lazybeforeunveil", b)).defaultPrevented || (e && (c ? s(a, d.autosizesClass) : a.setAttribute("sizes", e)), h = a[i](d.srcsetAttr), g = a[i](d.srcAttr), f && (j = a.parentNode, l = j && n.test(j.nodeName || "")), p = b.firesLoad || "src" in a && (h || g || l), m = {
        target: a
      }, s(a, d.loadingClass), p && (clearTimeout(o), o = k(S, 2500), u(a, Z, !0)), l && q.call(j.getElementsByTagName("source"), _), h ? a.setAttribute("srcset", h) : g && !l && (M.test(a.nodeName) ? $(a, g) : a.src = g), f && (h || l) && w(a, {
        src: g
      })), a._lazyRace && delete a._lazyRace, t(a, d.lazyClass), z(function () {
        var b = a.complete && a.naturalWidth > 1;
        p && !b || (b && s(a, "ls-is-cached"), X(m), a._lazyCache = !0, k(function () {
          "_lazyCache" in a && delete a._lazyCache;
        }, 9)), "lazy" == a.loading && Q--;
      }, !0);
    }),
        ba = function ba(a) {
      if (!a._lazyRace) {
        var b,
            c = L.test(a.nodeName),
            e = c && (a[i](d.sizesAttr) || a[i]("sizes")),
            f = "auto" == e;
        (!f && m || !c || !a[i]("src") && !a.srcset || a.complete || r(a, d.errorClass) || !r(a, d.lazyClass)) && (b = v(a, "lazyunveilread").detail, f && E.updateElem(a, !0, a.offsetWidth), a._lazyRace = !0, Q++, aa(a, b, f, e, c));
      }
    },
        ca = C(function () {
      d.loadMode = 3, W();
    }),
        da = function da() {
      3 == d.loadMode && (d.loadMode = 2), ca();
    },
        ea = function ea() {
      if (!m) {
        if (f.now() - y < 999) return void k(ea, 999);
        m = !0, d.loadMode = 3, W(), j("scroll", da, !0);
      }
    };

    return {
      _: function _() {
        y = f.now(), c.elements = b.getElementsByClassName(d.lazyClass), g = b.getElementsByClassName(d.lazyClass + " " + d.preloadClass), j("scroll", W, !0), j("resize", W, !0), j("pageshow", function (a) {
          if (a.persisted) {
            var c = b.querySelectorAll("." + d.loadingClass);
            c.length && c.forEach && l(function () {
              c.forEach(function (a) {
                a.complete && ba(a);
              });
            });
          }
        }), a.MutationObserver ? new MutationObserver(W).observe(e, {
          childList: !0,
          subtree: !0,
          attributes: !0
        }) : (e[h]("DOMNodeInserted", W, !0), e[h]("DOMAttrModified", W, !0), setInterval(W, 999)), j("hashchange", W, !0), ["focus", "mouseover", "click", "load", "transitionend", "animationend"].forEach(function (a) {
          b[h](a, W, !0);
        }), /d$|^c/.test(b.readyState) ? ea() : (j("load", ea), b[h]("DOMContentLoaded", W), k(ea, 2e4)), c.elements.length ? (V(), z._lsFlush()) : W();
      },
      checkElems: W,
      unveil: ba,
      _aLSL: da
    };
  }(),
      E = function () {
    var a,
        c = A(function (a, b, c, d) {
      var e, f, g;
      if (a._lazysizesWidth = d, d += "px", a.setAttribute("sizes", d), n.test(b.nodeName || "")) for (e = b.getElementsByTagName("source"), f = 0, g = e.length; f < g; f++) {
        e[f].setAttribute("sizes", d);
      }
      c.detail.dataAttr || w(a, c.detail);
    }),
        e = function e(a, b, d) {
      var e,
          f = a.parentNode;
      f && (d = y(a, f, d), e = v(a, "lazybeforesizes", {
        width: d,
        dataAttr: !!b
      }), e.defaultPrevented || (d = e.detail.width) && d !== a._lazysizesWidth && c(a, f, e, d));
    },
        f = function f() {
      var b,
          c = a.length;
      if (c) for (b = 0; b < c; b++) {
        e(a[b]);
      }
    },
        g = C(f);

    return {
      _: function _() {
        a = b.getElementsByClassName(d.autosizesClass), j("resize", g);
      },
      checkElems: g,
      updateElem: e
    };
  }(),
      F = function F() {
    !F.i && b.getElementsByClassName && (F.i = !0, E._(), D._());
  };

  return k(function () {
    d.init && F();
  }), c = {
    cfg: d,
    autoSizer: E,
    loader: D,
    init: F,
    uP: w,
    aC: s,
    rC: t,
    hC: r,
    fire: v,
    gW: y,
    rAF: z
  };
});
/*! lazysizes - v5.2.0-beta1 */

!function (a, b) {
  var c = function c() {
    b(a.lazySizes), a.removeEventListener("lazyunveilread", c, !0);
  };

  b = b.bind(null, a, a.document), "object" == (typeof module === "undefined" ? "undefined" : _typeof(module)) && module.exports ? b(require("lazysizes")) : a.lazySizes ? c() : a.addEventListener("lazyunveilread", c, !0);
}(window, function (a, b, c) {
  "use strict";

  if (a.addEventListener) {
    var d = c.cfg,
        e = /\s+/g,
        f = /\s*\|\s+|\s+\|\s*/g,
        g = /^(.+?)(?:\s+\[\s*(.+?)\s*\])(?:\s+\[\s*(.+?)\s*\])?$/,
        h = /^\s*\(*\s*type\s*:\s*(.+?)\s*\)*\s*$/,
        i = /\(|\)|'/,
        j = {
      contain: 1,
      cover: 1
    },
        k = function k(a) {
      var b = c.gW(a, a.parentNode);
      return (!a._lazysizesWidth || b > a._lazysizesWidth) && (a._lazysizesWidth = b), a._lazysizesWidth;
    },
        l = function l(a) {
      var b;
      return b = (getComputedStyle(a) || {
        getPropertyValue: function getPropertyValue() {}
      }).getPropertyValue("background-size"), !j[b] && j[a.style.backgroundSize] && (b = a.style.backgroundSize), b;
    },
        m = function m(a, b) {
      if (b) {
        var c = b.match(h);
        c && c[1] ? a.setAttribute("type", c[1]) : a.setAttribute("media", d.customMedia[b] || b);
      }
    },
        n = function n(a, c, h) {
      var i = b.createElement("picture"),
          j = c.getAttribute(d.sizesAttr),
          k = c.getAttribute("data-ratio"),
          l = c.getAttribute("data-optimumx");
      c._lazybgset && c._lazybgset.parentNode == c && c.removeChild(c._lazybgset), Object.defineProperty(h, "_lazybgset", {
        value: c,
        writable: !0
      }), Object.defineProperty(c, "_lazybgset", {
        value: i,
        writable: !0
      }), a = a.replace(e, " ").split(f), i.style.display = "none", h.className = d.lazyClass, 1 != a.length || j || (j = "auto"), a.forEach(function (a) {
        var c,
            e = b.createElement("source");
        j && "auto" != j && e.setAttribute("sizes", j), (c = a.match(g)) ? (e.setAttribute(d.srcsetAttr, c[1]), m(e, c[2]), m(e, c[3])) : e.setAttribute(d.srcsetAttr, a), i.appendChild(e);
      }), j && (h.setAttribute(d.sizesAttr, j), c.removeAttribute(d.sizesAttr), c.removeAttribute("sizes")), l && h.setAttribute("data-optimumx", l), k && h.setAttribute("data-ratio", k), i.appendChild(h), c.appendChild(i);
    },
        o = function o(a) {
      if (a.target._lazybgset) {
        var b = a.target,
            d = b._lazybgset,
            e = b.currentSrc || b.src;

        if (e) {
          var f = c.fire(d, "bgsetproxy", {
            src: e,
            useSrc: i.test(e) ? JSON.stringify(e) : e
          });
          f.defaultPrevented || (d.style.backgroundImage = "url(" + f.detail.useSrc + ")");
        }

        b._lazybgsetLoading && (c.fire(d, "_lazyloaded", {}, !1, !0), delete b._lazybgsetLoading);
      }
    };

    addEventListener("lazybeforeunveil", function (a) {
      var d, e, f;
      !a.defaultPrevented && (d = a.target.getAttribute("data-bgset")) && (f = a.target, e = b.createElement("img"), e.alt = "", e._lazybgsetLoading = !0, a.detail.firesLoad = !0, n(d, f, e), setTimeout(function () {
        c.loader.unveil(e), c.rAF(function () {
          c.fire(e, "_lazyloaded", {}, !0, !0), e.complete && o({
            target: e
          });
        });
      }));
    }), b.addEventListener("load", o, !0), a.addEventListener("lazybeforesizes", function (a) {
      if (a.detail.instance == c && a.target._lazybgset && a.detail.dataAttr) {
        var b = a.target._lazybgset,
            d = l(b);
        j[d] && (a.target._lazysizesParentFit = d, c.rAF(function () {
          a.target.setAttribute("data-parent-fit", d), a.target._lazysizesParentFit && delete a.target._lazysizesParentFit;
        }));
      }
    }, !0), b.documentElement.addEventListener("lazybeforesizes", function (a) {
      !a.defaultPrevented && a.target._lazybgset && a.detail.instance == c && (a.detail.width = k(a.target._lazybgset));
    });
  }
});
/*! lazysizes - v5.2.0-beta1 */

!function (a, b) {
  var c = function c() {
    b(a.lazySizes), a.removeEventListener("lazyunveilread", c, !0);
  };

  b = b.bind(null, a, a.document), "object" == (typeof module === "undefined" ? "undefined" : _typeof(module)) && module.exports ? b(require("lazysizes")) : a.lazySizes ? c() : a.addEventListener("lazyunveilread", c, !0);
}(window, function (a, b, c) {
  "use strict";

  function d(a, c) {
    if (!g[a]) {
      var d = b.createElement(c ? "link" : "script"),
          e = b.getElementsByTagName("script")[0];
      c ? (d.rel = "stylesheet", d.href = a) : d.src = a, g[a] = !0, g[d.src || d.href] = !0, e.parentNode.insertBefore(d, e);
    }
  }

  var e,
      f,
      g = {};
  b.addEventListener && (f = /\(|\)|\s|'/, e = function e(a, c) {
    var d = b.createElement("img");
    d.onload = function () {
      d.onload = null, d.onerror = null, d = null, c();
    }, d.onerror = d.onload, d.src = a, d && d.complete && d.onload && d.onload();
  }, addEventListener("lazybeforeunveil", function (a) {
    if (a.detail.instance == c) {
      var b, g, h, i;

      if (!a.defaultPrevented) {
        var j = a.target;
        if ("none" == j.preload && (j.preload = "auto"), null != j.getAttribute("data-autoplay")) if (j.getAttribute("data-expand") && !j.autoplay) try {
          j.play();
        } catch (a) {} else requestAnimationFrame(function () {
          j.setAttribute("data-expand", "-10"), c.aC(j, c.cfg.lazyClass);
        });
        b = j.getAttribute("data-link"), b && d(b, !0), b = j.getAttribute("data-script"), b && d(b), b = j.getAttribute("data-require"), b && (c.cfg.requireJs ? c.cfg.requireJs([b]) : d(b)), h = j.getAttribute("data-bg"), h && (a.detail.firesLoad = !0, g = function g() {
          j.style.backgroundImage = "url(" + (f.test(h) ? JSON.stringify(h) : h) + ")", a.detail.firesLoad = !1, c.fire(j, "_lazyloaded", {}, !0, !0);
        }, e(h, g)), i = j.getAttribute("data-poster"), i && (a.detail.firesLoad = !0, g = function g() {
          j.poster = i, a.detail.firesLoad = !1, c.fire(j, "_lazyloaded", {}, !0, !0);
        }, e(i, g));
      }
    }
  }, !1));
});

var LiteYTEmbed = /*#__PURE__*/function (_HTMLElement) {
  _inherits(LiteYTEmbed, _HTMLElement);

  var _super = _createSuper(LiteYTEmbed);

  function LiteYTEmbed() {
    _classCallCheck(this, LiteYTEmbed);

    return _super.apply(this, arguments);
  }

  _createClass(LiteYTEmbed, [{
    key: "connectedCallback",
    value: function connectedCallback() {
      var _this = this;

      this.videoId = this.getAttribute('videoid'); // let playBtnEl = this.querySelector('.lty-playbtn');
      // // A label for the button takes priority over a [playlabel] attribute on the custom-element
      // this.playLabel = (playBtnEl && playBtnEl.textContent.trim()) || this.getAttribute('playlabel') || 'Play';

      /**
       * Lo, the youtube placeholder image!  (aka the thumbnail, poster image, etc)
       *
       * See https://github.com/paulirish/lite-youtube-embed/blob/master/youtube-thumbnail-urls.md
       *
       * TODO: Do the sddefault->hqdefault fallback
       *       - When doing this, apply referrerpolicy (https://github.com/ampproject/amphtml/pull/3940)
       * TODO: Consider using webp if supported, falling back to jpg
       */

      if (!this.style.backgroundImage) {
        this.posterUrl = "https://i.ytimg.com/vi/".concat(this.videoId, "/hqdefault.jpg");
        LiteYTEmbed.addPrefetch('preload', this.posterUrl, 'image');
        this.style.backgroundImage = "url(\"".concat(this.posterUrl, "\")");
      } // // Set up play button, and its visually hidden label
      // if (!playBtnEl) {
      //     playBtnEl = document.createElement('button');
      //     playBtnEl.type = 'button';
      //     playBtnEl.classList.add('lty-playbtn');
      //     this.append(playBtnEl);
      // }
      // if (!playBtnEl.textContent) {
      //     const playBtnLabelEl = document.createElement('span');
      //     playBtnLabelEl.className = 'lyt-visually-hidden';
      //     playBtnLabelEl.textContent = this.playLabel;
      //     playBtnEl.append(playBtnLabelEl);
      // }
      // On hover (or tap), warm up the TCP connections we're (likely) about to use.


      this.addEventListener('pointerover', LiteYTEmbed.warmConnections, {
        once: true
      }); // Once the user clicks, add the real iframe and drop our play button
      // TODO: In the future we could be like amp-youtube and silently swap in the iframe during idle time
      //   We'd want to only do this for in-viewport or near-viewport ones: https://github.com/ampproject/amphtml/pull/5003

      this.addEventListener('click', function (e) {
        return _this.addIframe();
      });
    } // // TODO: Support the the user changing the [videoid] attribute
    // attributeChangedCallback() {
    // }

    /**
     * Add a <link rel={preload | preconnect} ...> to the head
     */

  }, {
    key: "addIframe",
    value: function addIframe() {
      var params = new URLSearchParams(this.getAttribute('params') || []);
      params.append('autoplay', '1');
      var iframeEl = document.createElement('iframe');
      iframeEl.width = '100%';
      iframeEl.height = '100%'; // No encoding necessary as [title] is safe. https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html#:~:text=Safe%20HTML%20Attributes%20include

      iframeEl.title = this.playLabel;
      iframeEl.allow = 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture';
      iframeEl.allowFullscreen = true; // AFAIK, the encoding here isn't necessary for XSS, but we'll do it only because this is a URL
      // https://stackoverflow.com/q/64959723/89484

      iframeEl.src = "https://www.youtube-nocookie.com/embed/".concat(encodeURIComponent(this.videoId), "?").concat(params.toString());
      this.innerHTML = "";
      this.append(iframeEl);
      this.classList.add('lyt-activated'); // Set focus for a11y

      this.querySelector('iframe').focus();
    }
  }], [{
    key: "addPrefetch",
    value: function addPrefetch(kind, url, as) {
      var linkEl = document.createElement('link');
      linkEl.rel = kind;
      linkEl.href = url;

      if (as) {
        linkEl.as = as;
      }

      document.head.append(linkEl);
    }
  }, {
    key: "warmConnections",
    value: function warmConnections() {
      if (LiteYTEmbed.preconnected) return; // The iframe document and most of its subresources come right off youtube.com
      // LiteYTEmbed.addPrefetch('preconnect', 'https://www.youtube-nocookie.com');
      // The botguard script is fetched off from google.com

      LiteYTEmbed.addPrefetch('preconnect', 'https://www.google.com'); // LiteYTEmbed.addPrefetch('preconnect', 'https://googleads.g.doubleclick.net');
      // LiteYTEmbed.addPrefetch('preconnect', 'https://static.doubleclick.net');

      LiteYTEmbed.preconnected = true;
    }
  }]);

  return LiteYTEmbed;
}( /*#__PURE__*/_wrapNativeSuper(HTMLElement)); // Register custome element


customElements.define('lite-youtube', LiteYTEmbed);
