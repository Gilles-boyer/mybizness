(function(t){function e(e){for(var i,n,o=e[0],l=e[1],c=e[2],m=0,d=[];m<o.length;m++)n=o[m],Object.prototype.hasOwnProperty.call(r,n)&&r[n]&&d.push(r[n][0]),r[n]=0;for(i in l)Object.prototype.hasOwnProperty.call(l,i)&&(t[i]=l[i]);u&&u(e);while(d.length)d.shift()();return s.push.apply(s,c||[]),a()}function a(){for(var t,e=0;e<s.length;e++){for(var a=s[e],i=!0,o=1;o<a.length;o++){var l=a[o];0!==r[l]&&(i=!1)}i&&(s.splice(e--,1),t=n(n.s=a[0]))}return t}var i={},r={app:0},s=[];function n(e){if(i[e])return i[e].exports;var a=i[e]={i:e,l:!1,exports:{}};return t[e].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=t,n.c=i,n.d=function(t,e,a){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},n.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)n.d(a,i,function(e){return t[e]}.bind(null,i));return a},n.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/";var o=window["webpackJsonp"]=window["webpackJsonp"]||[],l=o.push.bind(o);o.push=e,o=o.slice();for(var c=0;c<o.length;c++)e(o[c]);var u=l;s.push([0,"chunk-vendors"]),a()})({0:function(t,e,a){t.exports=a("56d7")},"3bcc":function(t,e,a){},4631:function(t,e,a){"use strict";a("3bcc")},"56d7":function(t,e,a){"use strict";a.r(e);var i=a("2b0e"),r=a("bc3a"),s=a.n(r);let n={};const o=s.a.create(n);o.interceptors.request.use((function(t){return t}),(function(t){return Promise.reject(t)})),o.interceptors.response.use((function(t){return t}),(function(t){return Promise.reject(t)})),Plugin.install=function(t,e){t.axios=o,window.axios=o,Object.defineProperties(t.prototype,{axios:{get(){return o}},$axios:{get(){return o}}})},i["a"].use(Plugin);Plugin;var l=a("7496"),c=a("40dc"),u=a("8336"),m=a("62ad"),d=a("553a"),p=a("132d"),h=a("adda"),f=a("f6c4"),v=a("0fd9"),b=a("2fa4"),g=function(){var t=this,e=t._self._c;return e(l["a"],[e(c["a"],{attrs:{app:"",color:"primary",dark:"",absolute:""}},[e("div",{staticClass:"d-flex align-center"},[e(u["a"],{attrs:{text:"",href:"https://www.cfg.re/"}},[e(h["a"],{staticClass:"shrink mr-2",attrs:{alt:"CFG logo",contain:"",src:t.url+"/public/logo.svg",transition:"scale-transition",width:"70"}})],1)],1),e(b["a"]),e(u["a"],{attrs:{href:"/",text:""}},[e("span",{staticClass:"mr-2"}),e(p["a"],[t._v("mdi-gift")]),e("span",{staticClass:"mr-2"}),t._v(" SOLUTION BON CADEAU ")],1)],1),e(f["a"],[e("router-view")],1),e(d["a"],{attrs:{padle:""}},[e(v["a"],{attrs:{justify:"center"}},[e(m["a"],{staticClass:"text-center primary--text text-overline ma-0 pa-0",attrs:{cols:"12"}},[t._v(" "+t._s((new Date).getFullYear())+" - CFG ")]),e(u["a"],{staticClass:"mb-2",attrs:{color:"primary",text:"",rounded:"",small:""}},[e(p["a"],{attrs:{small:""}},[t._v(" mdi-phone ")]),t._v(" 0692 725 584 ")],1),e(u["a"],{staticClass:"mb-2",attrs:{color:"primary",text:"",rounded:"",small:""}},[e(p["a"],{attrs:{small:""}},[t._v(" mdi-email ")]),t._v(" CONTACT ")],1)],1)],1)],1)},x=[],y=a("73e6"),w={name:"App",data:()=>({url:y.base})},_=w,C=a("2877"),k=Object(C["a"])(_,g,x,!1,null,null,null),A=k.exports,S=a("8c4f"),M=a("a523"),P=function(){var t=this,e=t._self._c;return e(M["a"],{staticClass:"home mb-2 pt-5",attrs:{"fill-height":"",fluid:"","align-center":"","justify-center":""}},[e(v["a"],{staticClass:"text-center pa-0 ma-0 f100"},[e(m["a"],{staticClass:"text-h5 text--primary font-weight-bold",attrs:{cols:"12"}},[t._v(" Votre solution Bon Cadeau CFG ")]),e(m["a"],{attrs:{cols:"12"}},[e("Notice")],1),e(m["a"],{attrs:{cols:"12"}},[e(u["a"],{attrs:{color:"primary",rounded:"",elevation:"10",to:"/boncadeau"}},[t._v(" COMMENCER ")])],1)],1)],1)},j=[],z=a("8212"),N=function(){var t=this,e=t._self._c;return e(M["a"],{staticStyle:{"background-color":"#04153b","border-radius":"20px"},attrs:{"fill-height":"","align-center":"","justify-center":"","elevation-10":""}},[e(v["a"],{staticClass:"white--text text-center f100 ma-1",attrs:{justify:"space-between"}},[e(m["a"],{attrs:{cols:"12",sm:"6",md:"3",xl:"2"}},[e(v["a"],{staticClass:"f100",attrs:{justify:"space-between"}},[e(m["a"],{attrs:{cols:"12"}},[e(z["a"],{attrs:{color:"error",size:"40"}},[e("span",{staticClass:"white--text text-h5"},[t._v("1")])])],1),e(m["a"],{attrs:{cols:"12"}},[t._v(" Je choisis mes cadeaux ")]),e(m["a"],{attrs:{cols:"12"}},[e(h["a"],{staticClass:"mx-auto pa-16",attrs:{"max-height":"200","max-width":"200",src:t.url+"/public/image/cadeau.png"}})],1)],1)],1),e(m["a"],{attrs:{cols:"12",sm:"6",md:"3",xl:"2"}},[e(v["a"],{staticClass:"f100"},[e(m["a"],{attrs:{cols:"12"}},[e(z["a"],{attrs:{color:"error",size:"40"}},[e("span",{staticClass:"white--text text-h5"},[t._v("2")])])],1),e(m["a"],{attrs:{cols:"12"}},[t._v(" Je personnalise mon Bon ")]),e(m["a"],{attrs:{cols:"12"}},[e(h["a"],{staticClass:"mx-auto pa-16",attrs:{"max-height":"200","max-width":"200",src:t.url+"/public/image/custum.png"}})],1)],1)],1),e(m["a"],{attrs:{cols:"12",sm:"6",md:"3",xl:"2"}},[e(v["a"],{staticClass:"f100"},[e(m["a"],{attrs:{cols:"12"}},[e(z["a"],{attrs:{color:"error",size:"40"}},[e("span",{staticClass:"white--text text-h5"},[t._v("3")])])],1),e(m["a"],{attrs:{cols:"12"}},[t._v(" Je complete le formulaire d'achat ")]),e(m["a"],{attrs:{cols:"12"}},[e(h["a"],{staticClass:"mx-auto pa-16",attrs:{"max-height":"200","max-width":"200",src:t.url+"/public/image/form.png"}})],1)],1)],1),e(m["a"],{attrs:{cols:"12",sm:"6",md:"3",xl:"2"}},[e(v["a"],{staticClass:"f100"},[e(m["a"],{attrs:{cols:"12"}},[e(z["a"],{attrs:{color:"error",size:"40"}},[e("span",{staticClass:"white--text text-h5"},[t._v("4")])])],1),e(m["a"],{attrs:{cols:"12"}},[t._v(" Je paye mon Bon Cadeau")]),e(m["a"],{attrs:{cols:"12"}},[e(h["a"],{staticClass:"mx-auto pa-16",attrs:{"max-height":"200","max-width":"200",src:t.url+"/public/image/cb.png"}})],1)],1)],1),e(m["a"],{attrs:{cols:"12",sm:"6",md:"3",xl:"2"}},[e(v["a"],{staticClass:"f100"},[e(m["a"],{attrs:{cols:"12"}},[e(z["a"],{attrs:{color:"error",size:"40"}},[e("span",{staticClass:"white--text text-h5"},[t._v("5")])])],1),e(m["a"],{attrs:{cols:"12"}},[t._v(" Je reçois ma facture et mon bon ")]),e(m["a"],{attrs:{cols:"12"}},[e(h["a"],{staticClass:"mx-auto pa-16",attrs:{"max-height":"200","max-width":"200",src:t.url+"/public/image/invoice.png"}})],1)],1)],1)],1)],1)},O=[],D={name:"Notice",data:()=>({url:y.base})},G=D,T=(a("4631"),Object(C["a"])(G,N,O,!1,null,null,null)),E=T.exports,F={name:"Home",components:{Notice:E},mounted(){}},H=F,L=Object(C["a"])(H,P,j,!1,null,null,null),q=L.exports,B=a("ce7e"),Y=a("7e85"),I=a("e516"),V=a("9c54"),Z=a("56a4"),W=function(){var t=this,e=t._self._c;return e(M["a"],{attrs:{"fill-height":"",fluid:"","align-center":"","justify-center":""}},[e(Y["a"],{staticClass:"f100",attrs:{width:"90%"},model:{value:t.e1,callback:function(e){t.e1=e},expression:"e1"}},[e(V["a"],[e(Z["a"],{staticClass:"font-weight-bold",attrs:{complete:t.e1>1,step:"1",color:"error"}},[t._v(" Je choisis mes cadeaux ")]),e(B["a"]),e(Z["a"],{attrs:{complete:t.e1>2,step:"2",color:"error"}},[t._v(" Je personnalise mon bon ")]),e(B["a"]),e(Z["a"],{attrs:{complete:t.e1>3,step:"3",color:"error"}},[t._v(" Je complete le formulaire d'achat ")]),e(B["a"]),e(Z["a"],{attrs:{step:"4",color:"error"}},[t._v(" Je paye mon Bon Cadeau ")])],1),e(V["b"],[e(I["a"],{attrs:{step:"1"}},[e("Step1",{on:{listGifts:function(e){return t.addListGifts(e)}}})],1),e(I["a"],{attrs:{step:"2"}},[e(u["a"],{attrs:{icon:""},on:{click:function(e){return t.backStep()}}},[e(p["a"],{attrs:{dense:"",color:"primary"}},[t._v("mdi-arrow-left-circle")])],1),e("Step2",{on:{dataPersonalization:function(e){return t.addPersonalization(e)}}})],1),e(I["a"],{attrs:{step:"3"}},[e(u["a"],{attrs:{icon:""},on:{click:function(e){return t.backStep()}}},[e(p["a"],{attrs:{dense:"",color:"primary"}},[t._v("mdi-arrow-left-circle")])],1),e("Step3",{on:{dataForm:function(e){return t.addDataForm(e)}}})],1),e(I["a"],{attrs:{step:"4"}},[e(u["a"],{attrs:{icon:""},on:{click:function(e){return t.backStep()}}},[e(p["a"],{attrs:{dense:"",color:"primary"}},[t._v("mdi-arrow-left-circle")])],1),e(v["a"],{staticClass:"pa-4",attrs:{justify:"center",align:"center"}},[e(u["a"],{staticClass:"mx-auto",attrs:{color:"primary",block:""},on:{click:function(e){return t.confirmationAndPaiement()}}},[e(p["a"],{staticClass:"mr-2"},[t._v("mdi-check-circle-outline")]),t._v(" Confirmer et Payer "),e(p["a"],{staticClass:"ml-2"},[t._v("mdi-cash")])],1)],1),e("Step4",{attrs:{confirmationData:t.voucher}}),e(v["a"],{staticClass:"pa-4",attrs:{justify:"center",align:"center"}},[e(u["a"],{staticClass:"mx-auto",attrs:{color:"primary",block:""},on:{click:function(e){return t.confirmationAndPaiement()}}},[e(p["a"],{staticClass:"mr-2"},[t._v("mdi-check-circle-outline")]),t._v(" Confirmer et Payer "),e(p["a"],{staticClass:"ml-2"},[t._v("mdi-cash")])],1),e("form",{staticStyle:{position:"absolute",top:"-999px",left:"-999px"},attrs:{id:"f_form91486208",action:"https://cte.vosfactures.fr/payments",method:"post"}})],1)],1)],1)],1)],1)},Q=[],J=(a("14d9"),a("0798")),K=a("8fea"),R=a("71d9"),U=a("2a7f"),X=function(){var t=this,e=t._self._c;return e(v["a"],[e(m["a"],{attrs:{cols:"12"}},[t.error?e(J["a"],{attrs:{type:"error"}},[t._v("Merci de selectionner un produit avant de continuer")]):t._e()],1),e(m["a"],{attrs:{cols:"12",sm:"12",md:"6",xl:"6"}},[e(R["a"],{attrs:{dense:"",elevation:"0"}},[e(U["a"],{staticClass:"primary--text"},[t._v("Merci de choisir vos produits dans la liste :")])],1),e("CatalogProduct",{on:{productToAdd:function(e){return t.addProduct(e)}}})],1),e(B["a"],{attrs:{vertical:""}}),e(m["a"],{attrs:{cols:"12",sm:"12",md:"6",xl:"6"}},[e(R["a"],{attrs:{dense:"",elevation:"0"}},[e(U["a"],{staticClass:"primary--text"},[t._v("Votre choix de Cadeaux :")])],1),e(K["a"],{attrs:{headers:t.headers,items:t.gifts,"hide-default-footer":""},scopedSlots:t._u([{key:"item.img",fn:function({item:t}){return[e(z["a"],[e("img",{attrs:{src:t.img,alt:t.label}})])]}},{key:"item.action",fn:function({index:a}){return[e(u["a"],{attrs:{icon:""},on:{click:function(e){return t.deleteProduct(a)}}},[e(p["a"],{attrs:{color:"error",medium:""}},[t._v("mdi-delete")])],1)]}},{key:"body.append",fn:function(){return[e("tr",[e("td"),e("td"),e("td"),e("td",{staticClass:"text-center font-weight-bold white--text",staticStyle:{"background-color":"#04153b"}},[t._v(" Total : "+t._s(t.totalGifts)+" € ")])])]},proxy:!0}])}),e(v["a"],{staticClass:"mt-4",attrs:{justify:"center"}},[e(u["a"],{staticClass:"my-4",attrs:{color:"primary",disabled:t.active},on:{click:function(e){return t.goToStep2()}}},[t._v(" Continuer ")])],1)],1)],1)},$=[],tt=a("99d9"),et=a("8860"),at=a("56b0"),it=a("da13"),rt=a("8270"),st=a("5d23"),nt=a("3a2f"),ot=function(){var t=this,e=t._self._c;return e(et["a"],t._l(t.categories,(function(a){return e(at["a"],{key:a.id,attrs:{"prepend-icon":a.icon,color:"primary","no-action":""},scopedSlots:t._u([{key:"activator",fn:function(){return[e(st["a"],[e(st["b"],{domProps:{textContent:t._s(a.name)}})],1)]},proxy:!0}],null,!0),model:{value:a.active,callback:function(e){t.$set(a,"active",e)},expression:"cat.active"}},t._l(a.products,(function(a){return e(it["a"],{key:a.id,staticClass:"pa-0"},[e(rt["a"],[e("img",{attrs:{src:a.img}})]),e(st["a"],[e(tt["a"],[e(nt["a"],{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function({on:i,attrs:r}){return[e("span",t._g(t._b({},"span",r,!1),i),[t._v(t._s(a.name)+" - "+t._s(a.price)+" € ")])]}}],null,!0)},[e("span",[t._v(" Le karting est un sport mécanique qui vous assure des sensations. Pratiqué sur un circuit extérieur ou intérieur, il exige beaucoup de concentration et une bonne dose de témérité. ")])])],1)],1),e(u["a"],{attrs:{text:"",color:"primary"},on:{click:function(e){return t.addProduct(a)}}},[t._v("Ajouter")])],1)})),1)})),1)},lt=[],ct=s.a.create({baseURL:"https://mybizness.herokuapp.com/api",headers:{"Content-Type":"application/json",Accept:"application/json"}}),ut={getProductByCat(){return ct.get("categories/online/get")}},mt={data(){return{categories:[]}},mounted(){this.initProducts()},methods:{async initProducts(){var t=await ut.getProductByCat();this.categories=t.data.data},addProduct(t){this.$emit("productToAdd",t)}}},dt=mt,pt=Object(C["a"])(dt,ot,lt,!1,null,null,null),ht=pt.exports,ft={components:{CatalogProduct:ht},methods:{addProduct(t){this.gifts.push(t)},deleteProduct(t){this.gifts.splice(t,1)},goToStep2(){this.error=!1,this.gifts.length>0&&this.totalGifts>0?this.$emit("listGifts",this.gifts):this.error=!0}},computed:{totalGifts(){var t=0;return this.active=!0,this.gifts.length>0&&(this.active=!1,this.gifts.forEach(e=>{t+=parseInt(e.price)})),t}},data(){return{gifts:[],active:!0,error:!1,headers:[{text:"Image",align:"start",sortable:!1,value:"img"},{text:"Produit",value:"label"},{text:"Prix",value:"price"},{text:"Action",value:"action"}]}}},vt=ft,bt=Object(C["a"])(vt,X,$,!1,null,null,null),gt=bt.exports,xt=a("4bd4"),yt=a("a797"),wt=a("b974"),_t=a("a844"),Ct=function(){var t=this,e=t._self._c;return e(v["a"],{staticClass:"f100",attrs:{justify:"center",align:"center"}},[e(m["a"],{attrs:{cols:"12",sm:"12",md:"8",xl:"8"}},[e("ModelBonKdo",{attrs:{themeGift:t.image,fontGift:t.font.name,messageGift:t.dataMessage,background:t.color.hex}})],1),e(m["a"],{attrs:{cols:"12",sm:"12",md:"4",xl:"4"}},[e(xt["a"],{ref:"form",attrs:{align:"center","lazy-validation":""},model:{value:t.valid,callback:function(e){t.valid=e},expression:"valid"}},[e(_t["a"],{attrs:{rules:t.messageRules,counter:150,label:"Votre message"},model:{value:t.message,callback:function(e){t.message=e},expression:"message"}}),e(wt["a"],{attrs:{items:t.images,"item-text":"name",rules:[t=>!!t.id||"Item is required"],label:"Theme du bon cadeau",required:"","return-object":""},model:{value:t.image,callback:function(e){t.image=e},expression:"image"}}),e(wt["a"],{attrs:{items:t.fonts,"item-text":"name","item-value":"font",rules:[t=>!!t.id||"Item is required"],label:"Style d'écriture du bon cadeau","return-object":"",required:""},model:{value:t.font,callback:function(e){t.font=e},expression:"font"}}),e(wt["a"],{attrs:{items:t.colors,"item-text":"name",rules:[t=>!!t.id||"Item is required"],label:"Couleur du Bon Cadeau",required:"","return-object":""},model:{value:t.color,callback:function(e){t.color=e},expression:"color"}}),e(u["a"],{attrs:{width:"100%",disabled:!t.valid,color:"primary"},on:{click:t.validate}},[t._v(" Valider ")])],1)],1),e(yt["a"],{attrs:{color:"primary",absolute:t.absolute,opacity:t.opacity,value:t.overlay}},[e(h["a"],{attrs:{src:t.url+"/public/image/rotatePhone.gif"}})],1)],1)},kt=[],At=a("b0af"),St=function(){var t=this,e=t._self._c;return e(At["a"],{staticClass:"rounded-xl white--text mt-4 mb-4",style:t.fontFamily,attrs:{color:t.background}},[e(v["a"],{staticClass:"f100 pa-2",attrs:{justify:"center","align-content":"center"}},[e(m["a"],{attrs:{cols:"3"}},[e(h["a"],{staticStyle:{"border-radius":"25px"},attrs:{"aspect-ratio":t.sizeImg,src:t.themeGift.src,alt:t.themeGift.description}})],1),e(m["a"],{attrs:{cols:"9"}},[e(v["a"],{staticClass:"f100",attrs:{align:"stretch",justify:"space-between","align-content":"space-between"}},[e(m["a"],{attrs:{cols:"12"}},[e(v["a"],{attrs:{justify:"space-between","align-content":"space-between"}},[e(m["a"],{staticClass:"pa-0",attrs:{cols:"9"}},[e(tt["b"],{staticClass:"text-caption text-sm-caption text-md-h6 text-xl-h6 pa-2"},[t._v("Bon Cadeau N°123456789 ")]),e(tt["a"],{staticClass:"text-caption text-sm-caption text-md-subtitle-2 text-xl-subtitle-2 px-2 py-0"},[t._v(" Félicitation Xxxxxxxx, ")])],1),e(m["a"],{attrs:{cols:"3"}},[e(h["a"],{attrs:{alt:"CFG logo",src:t.url+"/public/logo.svg"}})],1)],1)],1),e(m["a"],{staticClass:"pa-0",attrs:{cols:"6"}},[e(tt["a"],{staticClass:"text-caption text-sm-caption text-md-subtitle-2 text-xl-subtitle-2 px-2 py-0"},[t._v(" Nous avons le plaisir de vous acceuillir pour : ")]),e(At["a"],{staticClass:"rounded-xl primary--text text-center",attrs:{color:"white",width:"100%","min-height":"50px",elevation:"0"}},[e(it["a"],[e(st["a"],[e(st["b"],[t._v("Produit 1")]),e(st["b"],[t._v("Produit 2")]),e(st["b"],[t._v("Produit 3")]),e(st["b"],[t._v("Produit 4")]),e(st["b"],[t._v("Produit 5")])],1)],1)],1),e(b["a"]),e(tt["a"],{staticClass:"text-caption text-sm-caption text-md-subtitle-2 text-xl-subtitle-2 px-2 py-0"},[t._v(" Votre bon est valide jusqu'au : ")]),e(At["a"],{staticClass:"rounded-xl",attrs:{elevation:"0",color:"white",width:"100%","min-height":"30px"}},[e(tt["a"],{staticClass:"text-center primary--text"},[t._v("12-12-2022")])],1)],1),e(m["a"],{staticClass:"pa-0",attrs:{cols:"6"}},[e(v["a"],{attrs:{align:"center",justify:"center"}},[e(m["a"],{attrs:{cols:"11"}},[e(h["a"],{staticClass:"ml-auto",attrs:{width:"80",src:"data:image/png;base64,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"}})],1),e(m["a"],{attrs:{cols:"11"}},[e(At["a"],{staticClass:"rounded-xl primary--text text-center",attrs:{elevation:"0",color:"white",width:"100%","min-height":"100"}},[e(tt["a"],[t._v(" "+t._s(t.messageGift)+" ")])],1)],1)],1)],1),e(m["a"],{attrs:{cols:"11"}},[e(v["a"],{staticClass:"pb-0",attrs:{justify:"center"}},[e(m["a"],{staticClass:"text-sm-caption",attrs:{cols:"12"}},[t._v(" Pour profiter de votre cadeau, Réservez vite au 0692 725 584 "),e(v["a"],{staticClass:"text-center",attrs:{justify:"center",align:"center"}},[e(B["a"],{staticClass:"mr-3",attrs:{color:"white"}}),t._v(" www.cfg.re ")],1)],1)],1)],1)],1)],1)],1)],1)},Mt=[],Pt={props:{background:{default:"primary",type:String},messageGift:{default:"Votre Message",type:String},fontGift:{default:"Roboto",type:String},themeGift:{type:Object}},data:()=>({widthScreenSize:window.innerWidth,url:y.base}),methods:{myEventHandler(t){this.widthScreenSize=window.innerWidth}},computed:{sizeImg(){switch(!0){case this.widthScreenSize<=800:return 3/8;case this.widthScreenSize<=900:return 3/7;case this.widthScreenSize<=958:return.5;case this.widthScreenSize<=1100:return 3/9;case this.widthScreenSize<=1200:return 3/8;case this.widthScreenSize<=1300:return 3/7;case this.widthScreenSize<=1500:return.5;case this.widthScreenSize<=1700:return.6;default:return 5/7}},fontFamily(){return`font-family: ${this.fontGift} , sans-serif;`}},created(){window.addEventListener("resize",this.myEventHandler)}},jt=Pt,zt=Object(C["a"])(jt,St,Mt,!1,null,null,null),Nt=zt.exports,Ot={getImages(){return ct.get("images/online/get")}},Dt={getFonts(){return ct.get("fonts/online/get")}},Gt={getColors(){return ct.get("colors/online/get")}},Tt={components:{ModelBonKdo:Nt},data:()=>({url:y.base,absolute:!0,color:{},colors:[],images:[],fonts:[],font:{},image:{},opacity:1,overlay:!1,valid:!0,message:"Votre message",messageRules:[t=>t.length<=150||"Merci de vérifier le nombre de caractère"]}),computed:{dataMessage(){return this.message=this.message.substring(0,150)}},methods:{chargePolice(t){document.head.insertAdjacentHTML("beforeend",`<style>@import url('${t.font}');</style>`)},async initColor(){var t=await Gt.getColors();this.colors=t.data.data},async initImage(){var t=await Ot.getImages();this.images=t.data.data},async initFont(){var t=await Dt.getFonts();this.fonts=t.data.data,t.data.data.forEach(t=>this.chargePolice(t))},validate(){if(this.$refs.form.validate()){"Votre message"==this.message&&(this.message="A trés vite au circuit !");var t={color:this.color.id,image:this.image.id,font:this.font.id,message:this.message};this.$emit("dataPersonalization",t)}},checkSizeWindowWidth(){return window.innerWidth<550?this.overlay=!0:this.overlay=!1},myEventHandler(t){this.checkSizeWindowWidth()}},mounted(){this.checkSizeWindowWidth(),this.initImage(),this.initFont(),this.initColor()},created(){window.addEventListener("resize",this.myEventHandler)},destroyed(){window.removeEventListener("resize",this.myEventHandler)}},Et=Tt,Ft=Object(C["a"])(Et,Ct,kt,!1,null,null,null),Ht=Ft.exports,Lt=a("ac7c"),qt=a("8654"),Bt=function(){var t=this,e=t._self._c;return e(xt["a"],{ref:"form",attrs:{"lazy-validation":""},model:{value:t.valid,callback:function(e){t.valid=e},expression:"valid"}},[e(v["a"],[e(m["a"],{attrs:{cols:"12",sm:"12",md:"6",xl:"6"}},[e(it["a"],[e(st["a"],[e(st["b"],{staticClass:"font-weight-bold text--primary"},[t._v("Vos Informations : ")])],1)],1),e(Lt["a"],{attrs:{label:"Ce cadeau est pour moi",required:""},model:{value:t.checkbox,callback:function(e){t.checkbox=e},expression:"checkbox"}}),e(qt["a"],{attrs:{rules:[t.rule.required,t.rule.minChar],label:"Nom",required:""},model:{value:t.client.lastName,callback:function(e){t.$set(t.client,"lastName",e)},expression:"client.lastName"}}),e(qt["a"],{attrs:{rules:[t.rule.required,t.rule.minChar],label:"Prénom",required:""},model:{value:t.client.firstName,callback:function(e){t.$set(t.client,"firstName",e)},expression:"client.firstName"}}),e(qt["a"],{attrs:{counter:10,rules:[t.rule.required,t.rule.minCharTel,t.rule.number],label:"Téléphone",required:""},model:{value:t.client.tel,callback:function(e){t.$set(t.client,"tel",e)},expression:"client.tel"}}),e(qt["a"],{attrs:{rules:[t.rule.required,t.rule.validMail],label:"E-mail",required:""},model:{value:t.client.email,callback:function(e){t.$set(t.client,"email",e)},expression:"client.email"}}),e(wt["a"],{attrs:{items:t.shippings,"item-text":"name",rules:[t.rule.required],label:"Mode de transmission du bon cadeau",required:"","return-object":""},model:{value:t.shipping,callback:function(e){t.shipping=e},expression:"shipping"}})],1),e(B["a"],{attrs:{vertical:""}}),t.checkbox?t._e():e(m["a"],{attrs:{cols:"12",sm:"12",md:"6",xl:"6"}},[e(it["a"],[e(st["a"],[e(st["b"],{staticClass:"font-weight-bold text--primary"},[t._v("Les informations du bénéficiaire : ")])],1)],1),e(qt["a"],{attrs:{rules:[t.rule.required,t.rule.minChar],label:"Nom",required:""},model:{value:t.beneficiary.lastName,callback:function(e){t.$set(t.beneficiary,"lastName",e)},expression:"beneficiary.lastName"}}),e(qt["a"],{attrs:{rules:[t.rule.required,t.rule.minChar],label:"Prénom",required:""},model:{value:t.beneficiary.firstName,callback:function(e){t.$set(t.beneficiary,"firstName",e)},expression:"beneficiary.firstName"}}),e(qt["a"],{attrs:{counter:10,rules:[t.rule.required,t.rule.minCharTel,t.rule.number],label:"Téléphone",required:""},model:{value:t.beneficiary.tel,callback:function(e){t.$set(t.beneficiary,"tel",e)},expression:"beneficiary.tel"}}),t.shipping.beneficiaryMailOptional?t._e():e(qt["a"],{attrs:{rules:[t.rule.required,t.rule.validMail],label:"E-mail",required:""},model:{value:t.beneficiary.email,callback:function(e){t.$set(t.beneficiary,"email",e)},expression:"beneficiary.email"}})],1),e(m["a"],{attrs:{cols:"12"}},[e(v["a"],{staticClass:"pa-3",attrs:{align:"center",justify:"center"}},[e(u["a"],{attrs:{disabled:!t.valid,color:"primary",width:"30%"},on:{click:t.validate}},[t._v(" Validate ")])],1)],1)],1)],1)},Yt=[],It={getShipping(){return ct.get("shippings/online/get")}},Vt={data:()=>({valid:!0,client:{firstName:"",lastName:"",tel:"",email:""},beneficiary:{firstName:"",lastName:"",tel:"",email:""},shipping:"",rule:{required:t=>!!t||"Ce champ est obligatoire",minCharTel:t=>!(10!=t.length)||"Merci de saisir le nombre minimun de caratère : 10",validMail:t=>/.+@.+\..+/.test(t)||"Merci de saisir un mail valide",minChar:t=>t.length>=3||"Merci de saisir plus de 2 caratères",number:t=>/[0-9]/.test(t)||"Merci de saisir que des chiffres"},shippings:[],checkbox:!1}),mounted(){this.initShipping()},methods:{async initShipping(){var t=await It.getShipping();this.shippings=t.data.data},validate(){if(this.$refs.form.validate()){var t={customer:this.client,shipping:this.shipping};this.checkbox?t.beneficiary=this.client:t.beneficiary=this.beneficiary,this.$emit("dataForm",t)}}}},Zt=Vt,Wt=Object(C["a"])(Zt,Bt,Yt,!1,null,null,null),Qt=Wt.exports,Jt=function(){var t=this,e=t._self._c;return e(At["a"],{staticClass:"mb-12 pb-3 white--text rounded-xl",attrs:{color:"primary"}},[e(tt["b"],[t._v(" Vos informations : ")]),e(tt["a"],{staticClass:"mx-auto pt-2 rounded-xl primary--text",staticStyle:{"background-color":"white",width:"80%"}},[e("strong",[t._v("Nom et Prénom :")]),t._v(" "+t._s((t.confirmationData.client.firstName+" "+t.confirmationData.client.lastName).toUpperCase())+" "),e("br"),e("strong",[t._v("Mail :")]),t._v(" "+t._s(t.confirmationData.client.email)+" "),e("br"),e("strong",[t._v("tel :")]),t._v(" "+t._s(t.confirmationData.client.tel)+" ")]),e(tt["b"],[t._v(" Informations du bénéficiaire : ")]),e(tt["a"],{staticClass:"mx-auto pt-2 rounded-xl primary--text",staticStyle:{"background-color":"white",width:"80%"}},[e("strong",[t._v("Nom et Prénom :")]),t._v(" "+t._s((t.confirmationData.beneficiary.firstName+" "+t.confirmationData.beneficiary.lastName).toUpperCase())+" "),e("br"),e("strong",[t._v("Mail :")]),t._v(" "+t._s(t.confirmationData.beneficiary.email)+" "),e("br"),e("strong",[t._v("tel :")]),t._v(" "+t._s(t.confirmationData.beneficiary.tel)+" ")]),e(tt["b"],[t._v(" Méthode d'envoie : ")]),e(tt["a"],{staticClass:"mx-auto pt-2 rounded-xl primary--text",staticStyle:{"background-color":"white",width:"80%"}},[t._v(" "+t._s(t.confirmationData.shipping.name)+" ")]),e(tt["b"],[t._v(" Votre personnalisation du bon: ")]),e(tt["a"],{staticClass:"mx-auto pt-2 rounded-xl primary--text",staticStyle:{"background-color":"white",width:"80%"}},[e("strong",[t._v("Message :")]),t._v(" "+t._s(t.confirmationData.personalization.message)+" "),e("br"),e("strong",[t._v("Image :")]),t._v(" "+t._s(t.confirmationData.personalization.image.name)+" "),e("br"),e("strong",[t._v("Couleur du bon :")]),e(p["a"],{attrs:{color:t.confirmationData.personalization.color.hex}},[t._v("mdi-circle")]),e("br"),e("strong",[t._v("Style d'écriture :")]),t._v(" "+t._s(t.confirmationData.personalization.font.font)+" ")],1),e(tt["b"],[t._v(" Liste des cadeaux : ")]),e(tt["a"],{staticClass:"mx-auto pt-2 rounded-xl primary--text",staticStyle:{"background-color":"white",width:"80%"}},[t._l(t.confirmationData.gifts,(function(a,i){return e(tt["a"],{key:i},[e("strong",[t._v("Désignation:")]),t._v(" "+t._s(a.name)+" "),e("br"),e("strong",[t._v(" valeur :")]),t._v(" "+t._s(a.price)+"€ ")])})),e(it["a"],[e(st["a"],[e(st["b"],[e("strong",[t._v("Total à payer:")]),t._v(" "+t._s(t.totalGift)+"€")])],1)],1)],2)],1)},Kt=[],Rt={props:{confirmationData:{type:Object}},computed:{totalGift(){var t=0;return this.confirmationData.gifts.length>0&&this.confirmationData.gifts.forEach(e=>t+=parseInt(e.price)),t}}},Ut=Rt,Xt=Object(C["a"])(Ut,Jt,Kt,!1,null,null,null),$t=Xt.exports,te={methods:{addListGifts(t){this.voucher.gifts=t,this.nextStep()},addPersonalization(t){this.voucher.personalization=t,console.log(this.voucher.personalization),this.nextStep()},addDataForm(t){this.voucher.customer=t.customer,this.voucher.beneficiary=t.beneficiary,this.voucher.shipping=t.shipping,this.nextStep()},confirmationAndPaiement(){var t=document.getElementById("f_form91486208"),e=[];this.voucher.gifts.forEach(t=>e.push(t.id)),t.innerHTML+='<input type="text" name="payment[kind]" value="autopayment"/>',t.innerHTML+='<input type="text" name="payment[account_id]" value="598713"/>',t.innerHTML+='<input type="text" name="payment[name]" value="bon cadeau"/>',t.innerHTML+='<input type="text" name="payment[product_id]" value="91486208"/>',t.innerHTML+='<input type="text" name="payment[provider]" value="stripe"/>',t.innerHTML+='<input type="text" name="payment[referrer]" value="https://cte.vosfactures.fr/"/>',t.innerHTML+='<input type="text" name="payment[generate_invoice]" value="1"/>',t.innerHTML+='<input type="text" name="lang" value="fr"/>',t.innerHTML+=`<input type="text" name="payment[first_name]" value="${this.voucher.customer.firstName}"/>`,t.innerHTML+=`<input type="text" name="payment[last_name]" value="${this.voucher.customer.lastName}"/>`,t.innerHTML+=`<input type="text" name="payment[email]" value="${this.voucher.customer.email}"/>`,t.innerHTML+=`<input type="text" name="payment[phone]" value="${this.voucher.customer.tel}"/>`,t.innerHTML+=`<input type="text" name="payment[price" value="${this.total.toString()}"/>`,t.innerHTML+=`<input type="text" name="payment[field1]" value='${JSON.stringify(this.voucher.beneficiary)}'/>`,t.innerHTML+=`<input type="text" name="payment[field2]" value='${JSON.stringify(this.voucher.personalization)}'/>`,t.innerHTML+=`<input type="text" name="payment[field3]" value='${this.voucher.shipping.id}'/>`,t.innerHTML+=`<input type="text" name="payment[field4]" value='${JSON.stringify(e)}'/>`,t.submit()},nextStep(){this.e1++},backStep(){this.e1--}},data(){return{e1:1,voucher:{client:{firstName:"",lastName:""},beneficiary:{firstName:"",lastName:""},shipping:{name:""},personalization:{color:"",font:"",message:"",image:""},gifts:[]}}},name:"BonCadeau",components:{Step1:gt,Step2:Ht,Step3:Qt,Step4:$t},computed:{total(){var t=0;return this.voucher.gifts.length>0&&this.voucher.gifts.forEach(e=>t+=parseInt(e.price)),t}}},ee=te,ae=Object(C["a"])(ee,W,Q,!1,null,null,null),ie=ae.exports;i["a"].use(S["a"]);const re=[{path:"/",name:"Home",component:q},{path:"/boncadeau",name:"BonCadeau",component:ie}],se=new S["a"]({routes:re});var ne=se,oe=a("2f62");i["a"].use(oe["a"]);var le=new oe["a"].Store({state:{base:"https://gilles-boyer.github.io/mybizness/form-voucher/"},mutations:{},actions:{},modules:{}}),ce=a("f309");i["a"].use(ce["a"]);var ue=new ce["a"]({theme:{themes:{light:{primary:"#04153B",secondary:"#A09F9F",accent:"#FD801F",error:"#FE001A"}}}});i["a"].config.productionTip=!1,new i["a"]({router:ne,store:le,vuetify:ue,render:t=>t(A)}).$mount("#app")},"73e6":function(t){t.exports=JSON.parse('{"base":"https://gilles-boyer.github.io/mybizness/form-voucher"}')}});
//# sourceMappingURL=app.36006341.js.map