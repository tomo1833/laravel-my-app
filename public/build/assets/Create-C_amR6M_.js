import{d as _,c as n,a as i,u as e,w as b,F as p,o as r,Z as x,b as o,e as f,f as c,v as m,t as d,g as a,bK as h}from"./app-BxpyNJtY.js";import{_ as y}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-BX7-WNjT.js";import{u as v}from"./index-Do0rY_L4.js";import"./ApplicationLogo-B3ipU6lz.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const g={class:"text-gray-600 body-font py-24 relative"},w={class:"container px-5 py-8 mx-auto bg-white"},k=o("div",{class:"flex flex-col text-center w-full mb-12"},[o("h1",{class:"sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"}," 教育ページ登録 ")],-1),V={class:"mb-4"},C=o("label",{class:"block mb-2"},"タイトル",-1),S={key:0,class:"text-red-500"},B={class:"mb-4"},E=o("label",{class:"block mb-2"},"本文（HTML）",-1),F={key:0,class:"text-red-500"},M={class:"mb-4"},N=o("label",{class:"block mb-2"},"表示順",-1),T={key:0,class:"text-red-500"},U=o("button",{type:"submit",class:"flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"}," 登録 ",-1),j=_({__name:"Create",setup(D){const t=v("post","/education",{id:null,title:null,body:null,body_html:null,order:null}),u=()=>{console.log("----------"),console.log(t.body_html),t.submit({preserveScroll:!0,onSuccess:()=>t.reset()})};return(H,s)=>(r(),n(p,null,[i(e(x),{title:"教育ページ登録"}),i(y,null,{default:b(()=>[o("section",g,[o("form",{onSubmit:f(u,["prevent"])},[o("div",w,[k,o("div",V,[C,c(o("input",{type:"text",name:"title","onUpdate:modelValue":s[0]||(s[0]=l=>e(t).title=l),class:"p-2 border rounded w-full"},null,512),[[m,e(t).title]]),e(t).invalid("title")?(r(),n("div",S,d(e(t).errors.title),1)):a("",!0)]),o("div",B,[E,i(e(h),{theme:"snow",content:e(t).body_html,"onUpdate:content":s[1]||(s[1]=l=>e(t).body_html=l),contentType:"html"},null,8,["content"]),e(t).invalid("body_html")?(r(),n("div",F,d(e(t).errors.body_html),1)):a("",!0)]),o("div",M,[N,c(o("input",{type:"text",name:"order","onUpdate:modelValue":s[2]||(s[2]=l=>e(t).order=l),class:"p-2 border rounded w-full"},null,512),[[m,e(t).order]]),e(t).invalid("order")?(r(),n("div",T,d(e(t).errors.order),1)):a("",!0)]),U])],32)])]),_:1})],64))}});export{j as default};