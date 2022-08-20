(function (t) {
  function e(e) {
    for (
      var s, n, i = e[0], l = e[1], c = e[2], u = 0, p = [];
      u < i.length;
      u++
    )
      (n = i[u]),
        Object.prototype.hasOwnProperty.call(r, n) && r[n] && p.push(r[n][0]),
        (r[n] = 0);
    for (s in l) Object.prototype.hasOwnProperty.call(l, s) && (t[s] = l[s]);
    m && m(e);
    while (p.length) p.shift()();
    return o.push.apply(o, c || []), a();
  }
  function a() {
    for (var t, e = 0; e < o.length; e++) {
      for (var a = o[e], s = !0, n = 1; n < a.length; n++) {
        var l = a[n];
        0 !== r[l] && (s = !1);
      }
      s && (o.splice(e--, 1), (t = i((i.s = a[0]))));
    }
    return t;
  }
  var s = {},
    r = { app: 0 },
    o = [];
  function n(t) {
    return (
      i.p +
      "js/" +
      ({ about: "about" }[t] || t) +
      "." +
      { about: "41ee5ac0" }[t] +
      ".js"
    );
  }
  function i(e) {
    if (s[e]) return s[e].exports;
    var a = (s[e] = { i: e, l: !1, exports: {} });
    return t[e].call(a.exports, a, a.exports, i), (a.l = !0), a.exports;
  }
  (i.e = function (t) {
    var e = [],
      a = r[t];
    if (0 !== a)
      if (a) e.push(a[2]);
      else {
        var s = new Promise(function (e, s) {
          a = r[t] = [e, s];
        });
        e.push((a[2] = s));
        var o,
          l = document.createElement("script");
        (l.charset = "utf-8"),
          (l.timeout = 120),
          i.nc && l.setAttribute("nonce", i.nc),
          (l.src = n(t));
        var c = new Error();
        o = function (e) {
          (l.onerror = l.onload = null), clearTimeout(u);
          var a = r[t];
          if (0 !== a) {
            if (a) {
              var s = e && ("load" === e.type ? "missing" : e.type),
                o = e && e.target && e.target.src;
              (c.message =
                "Loading chunk " + t + " failed.\n(" + s + ": " + o + ")"),
                (c.name = "ChunkLoadError"),
                (c.type = s),
                (c.request = o),
                a[1](c);
            }
            r[t] = void 0;
          }
        };
        var u = setTimeout(function () {
          o({ type: "timeout", target: l });
        }, 12e4);
        (l.onerror = l.onload = o), document.head.appendChild(l);
      }
    return Promise.all(e);
  }),
    (i.m = t),
    (i.c = s),
    (i.d = function (t, e, a) {
      i.o(t, e) || Object.defineProperty(t, e, { enumerable: !0, get: a });
    }),
    (i.r = function (t) {
      "undefined" !== typeof Symbol &&
        Symbol.toStringTag &&
        Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }),
        Object.defineProperty(t, "__esModule", { value: !0 });
    }),
    (i.t = function (t, e) {
      if ((1 & e && (t = i(t)), 8 & e)) return t;
      if (4 & e && "object" === typeof t && t && t.__esModule) return t;
      var a = Object.create(null);
      if (
        (i.r(a),
        Object.defineProperty(a, "default", { enumerable: !0, value: t }),
        2 & e && "string" != typeof t)
      )
        for (var s in t)
          i.d(
            a,
            s,
            function (e) {
              return t[e];
            }.bind(null, s)
          );
      return a;
    }),
    (i.n = function (t) {
      var e =
        t && t.__esModule
          ? function () {
              return t["default"];
            }
          : function () {
              return t;
            };
      return i.d(e, "a", e), e;
    }),
    (i.o = function (t, e) {
      return Object.prototype.hasOwnProperty.call(t, e);
    }),
    (i.p = "/"),
    (i.oe = function (t) {
      throw (console.error(t), t);
    });
  var l = (window["webpackJsonp"] = window["webpackJsonp"] || []),
    c = l.push.bind(l);
  (l.push = e), (l = l.slice());
  for (var u = 0; u < l.length; u++) e(l[u]);
  var m = c;
  o.push([0, "chunk-vendors"]), a();
})({
  0: function (t, e, a) {
    t.exports = a("56d7");
  },
  3957: function (t, e, a) {},
  "56d7": function (t, e, a) {
    "use strict";
    a.r(e);
    var s = a("2b0e"),
      r = a("bc3a"),
      o = a.n(r);
    let n = {};
    const i = o.a.create(n);
    i.interceptors.request.use(
      function (t) {
        return t;
      },
      function (t) {
        return Promise.reject(t);
      }
    ),
      i.interceptors.response.use(
        function (t) {
          return t;
        },
        function (t) {
          return Promise.reject(t);
        }
      ),
      (Plugin.install = function (t, e) {
        (t.axios = i),
          (window.axios = i),
          Object.defineProperties(t.prototype, {
            axios: {
              get() {
                return i;
              },
            },
            $axios: {
              get() {
                return i;
              },
            },
          });
      }),
      s["a"].use(Plugin);
    Plugin;
    var l = a("7496"),
      c = a("40dc"),
      u = a("8336"),
      m = a("62ad"),
      p = a("553a"),
      f = a("132d"),
      h = a("adda"),
      d = a("f6c4"),
      g = a("0fd9"),
      v = a("2fa4"),
      b = function () {
        var t = this,
          e = t._self._c;
        return e(
          l["a"],
          [
            e(
              c["a"],
              { attrs: { app: "", color: "primary", dark: "" } },
              [
                e(
                  "div",
                  { staticClass: "d-flex align-center" },
                  [
                    e(
                      u["a"],
                      { attrs: { text: "", href: "https://www.cfg.re/" } },
                      [
                        e(h["a"], {
                          staticClass: "shrink mr-2",
                          attrs: {
                            alt: "CFG logo",
                            contain: "",
                            src: "https://gilles-boyer.github.io/mybizness/form-voucher/dist/logo.svg",
                            transition: "scale-transition",
                            width: "70",
                          },
                        }),
                      ],
                      1
                    ),
                  ],
                  1
                ),
                e(v["a"]),
                e(
                  u["a"],
                  { attrs: { href: "/", text: "" } },
                  [
                    e("span", { staticClass: "mr-2" }),
                    e(f["a"], [t._v("mdi-gift")]),
                    e("span", { staticClass: "mr-2" }),
                    t._v(" SOLUTION BON CADEAU "),
                  ],
                  1
                ),
              ],
              1
            ),
            e(d["a"], [e("router-view")], 1),
            e(
              p["a"],
              { attrs: { padle: "" } },
              [
                e(
                  g["a"],
                  { attrs: { justify: "center" } },
                  [
                    e(
                      m["a"],
                      {
                        staticClass:
                          "text-center primary--text text-overline ma-0 pa-0",
                        attrs: { cols: "12" },
                      },
                      [t._v(" " + t._s(new Date().getFullYear()) + " - CFG ")]
                    ),
                    e(
                      u["a"],
                      {
                        staticClass: "mb-2",
                        attrs: {
                          color: "primary",
                          text: "",
                          rounded: "",
                          small: "",
                        },
                      },
                      [
                        e(f["a"], { attrs: { small: "" } }, [
                          t._v(" mdi-phone "),
                        ]),
                        t._v(" 0692 725 584 "),
                      ],
                      1
                    ),
                    e(
                      u["a"],
                      {
                        staticClass: "mb-2",
                        attrs: {
                          color: "primary",
                          text: "",
                          rounded: "",
                          small: "",
                        },
                      },
                      [
                        e(f["a"], { attrs: { small: "" } }, [
                          t._v(" mdi-email "),
                        ]),
                        t._v(" CONTACT "),
                      ],
                      1
                    ),
                  ],
                  1
                ),
              ],
              1
            ),
          ],
          1
        );
      },
      x = [],
      y = { name: "Test", data: () => ({}) },
      w = y,
      C = a("2877"),
      _ = Object(C["a"])(w, b, x, !1, null, null, null),
      j = _.exports,
      O = a("8c4f"),
      P = a("a523"),
      z = function () {
        var t = this,
          e = t._self._c;
        return e(
          P["a"],
          {
            staticClass: "home mb-2 pt-5",
            attrs: {
              "fill-height": "",
              fluid: "",
              "align-center": "",
              "justify-center": "",
            },
          },
          [
            e(
              g["a"],
              { staticClass: "text-center pa-0 ma-0 f100" },
              [
                e(m["a"], { attrs: { cols: "12" } }, [e("Notice")], 1),
                e(
                  m["a"],
                  {
                    staticClass: "ma-0 pa-0",
                    staticStyle: { height: "20px" },
                    attrs: { cols: "12" },
                  },
                  [
                    e(
                      u["a"],
                      {
                        attrs: {
                          color: "primary",
                          rounded: "",
                          elevation: "10",
                        },
                      },
                      [t._v(" COMMENCER ")]
                    ),
                  ],
                  1
                ),
              ],
              1
            ),
          ],
          1
        );
      },
      S = [],
      T = a("8212"),
      k = function () {
        var t = this,
          e = t._self._c;
        return e(
          P["a"],
          {
            staticStyle: {
              "background-color": "#04153b",
              "border-radius": "20px",
            },
            attrs: {
              "fill-height": "",
              "align-center": "",
              "justify-center": "",
              "elevation-10": "",
            },
          },
          [
            e(
              g["a"],
              {
                staticClass: "white--text text-center f100 ma-1",
                attrs: { justify: "space-between" },
              },
              [
                e(
                  m["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    e(
                      g["a"],
                      {
                        staticClass: "f100",
                        attrs: { justify: "space-between" },
                      },
                      [
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(
                              T["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                e(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("1")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        e(m["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je choisis mes cadeaux "),
                        ]),
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(h["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/cadeau.png",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                  ],
                  1
                ),
                e(
                  m["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    e(
                      g["a"],
                      { staticClass: "f100" },
                      [
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(
                              T["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                e(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("2")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        e(m["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je personnalise mon Bon "),
                        ]),
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(h["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/custum.png",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                  ],
                  1
                ),
                e(
                  m["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    e(
                      g["a"],
                      { staticClass: "f100" },
                      [
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(
                              T["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                e(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("3")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        e(m["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je complete le formulaire d'achat "),
                        ]),
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(h["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/form.png",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                  ],
                  1
                ),
                e(
                  m["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    e(
                      g["a"],
                      { staticClass: "f100" },
                      [
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(
                              T["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                e(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("4")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        e(m["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je paye mon Bon Cadeau"),
                        ]),
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(h["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/cb.png",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                  ],
                  1
                ),
                e(
                  m["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    e(
                      g["a"],
                      { staticClass: "f100" },
                      [
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(
                              T["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                e(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("5")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        e(m["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je reçois ma facture et mon bon "),
                        ]),
                        e(
                          m["a"],
                          { attrs: { cols: "12" } },
                          [
                            e(h["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/invoice.png",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                  ],
                  1
                ),
              ],
              1
            ),
          ],
          1
        );
      },
      E = [],
      F = { name: "HelloWorld", data: () => ({}) },
      A = F,
      J = (a("9500"), Object(C["a"])(A, k, E, !1, null, null, null)),
      M = J.exports,
      N = {
        name: "Home",
        components: { Notice: M },
        mounted() {
          console.log(document.getElementById("f_form41724983"));
        },
      },
      B = N,
      D = Object(C["a"])(B, z, S, !1, null, null, null),
      H = D.exports;
    s["a"].use(O["a"]);
    const L = [
        { path: "/", name: "Home", component: H },
        {
          path: "/about",
          name: "About",
          component: () => a.e("about").then(a.bind(null, "f820")),
        },
      ],
      q = new O["a"]({ mode: "history", base: "/", routes: L });
    var G = q,
      I = a("2f62");
    s["a"].use(I["a"]);
    var U = new I["a"].Store({
        state: {},
        mutations: {},
        actions: {},
        modules: {},
      }),
      $ = a("f309");
    s["a"].use($["a"]);
    var R = new $["a"]({
      theme: {
        themes: {
          light: {
            primary: "#04153B",
            secondary: "#A09F9F",
            accent: "#FD801F",
            error: "#FE001A",
          },
        },
      },
    });
    (s["a"].config.productionTip = !1),
      new s["a"]({
        router: G,
        store: U,
        vuetify: R,
        render: (t) => t(j),
      }).$mount("#app");
  },
  9500: function (t, e, a) {
    "use strict";
    a("3957");
  },
});
//# sourceMappingURL=app.53110a6d.js.map
