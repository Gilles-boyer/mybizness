(function (t) {
  function a(a) {
    for (
      var r, n, i = a[0], c = a[1], l = a[2], u = 0, f = [];
      u < i.length;
      u++
    )
      (n = i[u]),
        Object.prototype.hasOwnProperty.call(s, n) && s[n] && f.push(s[n][0]),
        (s[n] = 0);
    for (r in c) Object.prototype.hasOwnProperty.call(c, r) && (t[r] = c[r]);
    p && p(a);
    while (f.length) f.shift()();
    return o.push.apply(o, l || []), e();
  }
  function e() {
    for (var t, a = 0; a < o.length; a++) {
      for (var e = o[a], r = !0, n = 1; n < e.length; n++) {
        var c = e[n];
        0 !== s[c] && (r = !1);
      }
      r && (o.splice(a--, 1), (t = i((i.s = e[0]))));
    }
    return t;
  }
  var r = {},
    s = { app: 0 },
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
  function i(a) {
    if (r[a]) return r[a].exports;
    var e = (r[a] = { i: a, l: !1, exports: {} });
    return t[a].call(e.exports, e, e.exports, i), (e.l = !0), e.exports;
  }
  (i.e = function (t) {
    var a = [],
      e = s[t];
    if (0 !== e)
      if (e) a.push(e[2]);
      else {
        var r = new Promise(function (a, r) {
          e = s[t] = [a, r];
        });
        a.push((e[2] = r));
        var o,
          c = document.createElement("script");
        (c.charset = "utf-8"),
          (c.timeout = 120),
          i.nc && c.setAttribute("nonce", i.nc),
          (c.src = n(t));
        var l = new Error();
        o = function (a) {
          (c.onerror = c.onload = null), clearTimeout(u);
          var e = s[t];
          if (0 !== e) {
            if (e) {
              var r = a && ("load" === a.type ? "missing" : a.type),
                o = a && a.target && a.target.src;
              (l.message =
                "Loading chunk " + t + " failed.\n(" + r + ": " + o + ")"),
                (l.name = "ChunkLoadError"),
                (l.type = r),
                (l.request = o),
                e[1](l);
            }
            s[t] = void 0;
          }
        };
        var u = setTimeout(function () {
          o({ type: "timeout", target: c });
        }, 12e4);
        (c.onerror = c.onload = o), document.head.appendChild(c);
      }
    return Promise.all(a);
  }),
    (i.m = t),
    (i.c = r),
    (i.d = function (t, a, e) {
      i.o(t, a) || Object.defineProperty(t, a, { enumerable: !0, get: e });
    }),
    (i.r = function (t) {
      "undefined" !== typeof Symbol &&
        Symbol.toStringTag &&
        Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }),
        Object.defineProperty(t, "__esModule", { value: !0 });
    }),
    (i.t = function (t, a) {
      if ((1 & a && (t = i(t)), 8 & a)) return t;
      if (4 & a && "object" === typeof t && t && t.__esModule) return t;
      var e = Object.create(null);
      if (
        (i.r(e),
        Object.defineProperty(e, "default", { enumerable: !0, value: t }),
        2 & a && "string" != typeof t)
      )
        for (var r in t)
          i.d(
            e,
            r,
            function (a) {
              return t[a];
            }.bind(null, r)
          );
      return e;
    }),
    (i.n = function (t) {
      var a =
        t && t.__esModule
          ? function () {
              return t["default"];
            }
          : function () {
              return t;
            };
      return i.d(a, "a", a), a;
    }),
    (i.o = function (t, a) {
      return Object.prototype.hasOwnProperty.call(t, a);
    }),
    (i.p = "/"),
    (i.oe = function (t) {
      throw (console.error(t), t);
    });
  var c = (window["webpackJsonp"] = window["webpackJsonp"] || []),
    l = c.push.bind(c);
  (c.push = a), (c = c.slice());
  for (var u = 0; u < c.length; u++) a(c[u]);
  var p = l;
  o.push([0, "chunk-vendors"]), e();
})({
  0: function (t, a, e) {
    t.exports = e("56d7");
  },
  "2f9b": function (t, a, e) {
    t.exports =
      e.p +
      "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/invoice.png";
  },
  4051: function (t, a, e) {},
  "4f9c": function (t, a, e) {
    t.exports =
      e.p +
      "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/cb.png";
  },
  "539f": function (t, a, e) {
    t.exports =
      e.p +
      "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/cadeau.png";
  },
  "56d7": function (t, a, e) {
    "use strict";
    e.r(a);
    var r = e("2b0e"),
      s = e("bc3a"),
      o = e.n(s);
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
      (Plugin.install = function (t, a) {
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
      r["a"].use(Plugin);
    Plugin;
    var c = e("7496"),
      l = e("40dc"),
      u = e("8336"),
      p = e("62ad"),
      f = e("553a"),
      m = e("132d"),
      d = e("adda"),
      h = e("f6c4"),
      x = e("0fd9"),
      v = e("2fa4"),
      g = function () {
        var t = this,
          a = t._self._c;
        return a(
          c["a"],
          [
            a(
              l["a"],
              { attrs: { app: "", color: "primary", dark: "" } },
              [
                a(
                  "div",
                  { staticClass: "d-flex align-center" },
                  [
                    a(
                      u["a"],
                      { attrs: { text: "", href: "https://www.cfg.re/" } },
                      [
                        a(d["a"], {
                          staticClass: "shrink mr-2",
                          attrs: {
                            alt: "CFG logo",
                            contain: "",
                            src: e("7f01"),
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
                a(v["a"]),
                a(
                  u["a"],
                  { attrs: { href: "/", text: "" } },
                  [
                    a("span", { staticClass: "mr-2" }),
                    a(m["a"], [t._v("mdi-gift")]),
                    a("span", { staticClass: "mr-2" }),
                    t._v(" SOLUTION BON CADEAU "),
                  ],
                  1
                ),
              ],
              1
            ),
            a(h["a"], [a("router-view")], 1),
            a(
              f["a"],
              { attrs: { padle: "" } },
              [
                a(
                  x["a"],
                  { attrs: { justify: "center" } },
                  [
                    a(
                      p["a"],
                      {
                        staticClass:
                          "text-center primary--text text-overline ma-0 pa-0",
                        attrs: { cols: "12" },
                      },
                      [t._v(" " + t._s(new Date().getFullYear()) + " - CFG ")]
                    ),
                    a(
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
                        a(m["a"], { attrs: { small: "" } }, [
                          t._v(" mdi-phone "),
                        ]),
                        t._v(" 0692 725 584 "),
                      ],
                      1
                    ),
                    a(
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
                        a(m["a"], { attrs: { small: "" } }, [
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
      b = [],
      y = { name: "Test", data: () => ({}) },
      w = y,
      C = e("2877"),
      _ = Object(C["a"])(w, g, b, !1, null, null, null),
      j = _.exports,
      O = e("8c4f"),
      P = e("a523"),
      S = function () {
        var t = this,
          a = t._self._c;
        return a(
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
            a(
              x["a"],
              { staticClass: "text-center pa-0 ma-0 f100" },
              [
                a(p["a"], { attrs: { cols: "12" } }, [a("Notice")], 1),
                a(
                  p["a"],
                  {
                    staticClass: "ma-0 pa-0",
                    staticStyle: { height: "20px" },
                    attrs: { cols: "12" },
                  },
                  [
                    a(
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
      T = [],
      k = e("8212"),
      E = function () {
        var t = this,
          a = t._self._c;
        return a(
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
            a(
              x["a"],
              {
                staticClass: "white--text text-center f100 ma-1",
                attrs: { justify: "space-between" },
              },
              [
                a(
                  p["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    a(
                      x["a"],
                      {
                        staticClass: "f100",
                        attrs: { justify: "space-between" },
                      },
                      [
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(
                              k["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                a(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("1")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        a(p["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je choisis mes cadeaux "),
                        ]),
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(d["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: e("539f"),
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
                a(
                  p["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    a(
                      x["a"],
                      { staticClass: "f100" },
                      [
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(
                              k["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                a(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("2")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        a(p["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je personnalise mon Bon "),
                        ]),
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(d["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: e("d863"),
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
                a(
                  p["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    a(
                      x["a"],
                      { staticClass: "f100" },
                      [
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(
                              k["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                a(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("3")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        a(p["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je complete le formulaire d'achat "),
                        ]),
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(d["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: e("d6bb"),
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
                a(
                  p["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    a(
                      x["a"],
                      { staticClass: "f100" },
                      [
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(
                              k["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                a(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("4")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        a(p["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je paye mon Bon Cadeau"),
                        ]),
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(d["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: e("4f9c"),
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
                a(
                  p["a"],
                  { attrs: { cols: "12", sm: "6", md: "3", xl: "2" } },
                  [
                    a(
                      x["a"],
                      { staticClass: "f100" },
                      [
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(
                              k["a"],
                              { attrs: { color: "error", size: "40" } },
                              [
                                a(
                                  "span",
                                  { staticClass: "white--text text-h5" },
                                  [t._v("5")]
                                ),
                              ]
                            ),
                          ],
                          1
                        ),
                        a(p["a"], { attrs: { cols: "12" } }, [
                          t._v(" Je reçois ma facture et mon bon "),
                        ]),
                        a(
                          p["a"],
                          { attrs: { cols: "12" } },
                          [
                            a(d["a"], {
                              staticClass: "mx-auto pa-16",
                              attrs: {
                                "max-height": "200",
                                "max-width": "200",
                                src: e("2f9b"),
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
      F = [],
      A = { name: "HelloWorld", data: () => ({}) },
      J = A,
      M = (e("a72e"), Object(C["a"])(J, E, F, !1, null, null, null)),
      N = M.exports,
      z = {
        name: "Home",
        components: { Notice: N },
        mounted() {
          console.log(document.getElementById("f_form41724983"));
        },
      },
      B = z,
      D = Object(C["a"])(B, S, T, !1, null, null, null),
      H = D.exports;
    r["a"].use(O["a"]);
    const L = [
        { path: "/", name: "Home", component: H },
        {
          path: "/about",
          name: "About",
          component: () => e.e("about").then(e.bind(null, "f820")),
        },
      ],
      q = new O["a"]({ mode: "history", base: "/", routes: L });
    var G = q,
      I = e("2f62");
    r["a"].use(I["a"]);
    var U = new I["a"].Store({
        state: {},
        mutations: {},
        actions: {},
        modules: {},
      }),
      $ = e("f309");
    r["a"].use($["a"]);
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
    (r["a"].config.productionTip = !1),
      new r["a"]({
        router: G,
        store: U,
        vuetify: R,
        render: (t) => t(j),
      }).$mount("#app");
  },
  "7f01": function (t, a, e) {
    t.exports =
      e.p +
      "https://gilles-boyer.github.io/mybizness/form-voucher/dist/logo.svg";
  },
  a72e: function (t, a, e) {
    "use strict";
    e("4051");
  },
  d6bb: function (t, a, e) {
    t.exports =
      e.p +
      "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/form.png";
  },
  d863: function (t, a, e) {
    t.exports =
      e.p +
      "https://gilles-boyer.github.io/mybizness/form-voucher/dist/image/custum.png";
  },
});
//# sourceMappingURL=app.70105692.js.map
