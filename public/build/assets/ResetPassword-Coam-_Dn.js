import{d as c,T as f,j as w,w as n,o as _,a as o,u as e,Z as V,b as t,h as b,n as g,e as k}from"./app-BxpyNJtY.js";import{_ as v}from"./GuestLayout.vue_vue_type_script_setup_true_lang-DWxlGPqJ.js";import{_ as l,a as m,b as i}from"./TextInput.vue_vue_type_script_setup_true_lang-DPkEPCvX.js";import{P}from"./PrimaryButton-DVdfZPIs.js";import"./ApplicationLogo-B3ipU6lz.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const y={class:"mt-4"},x={class:"mt-4"},B={class:"flex items-center justify-end mt-4"},j=c({__name:"ResetPassword",props:{email:{},token:{}},setup(p){const d=p,s=f({token:d.token,email:d.email,password:"",password_confirmation:""}),u=()=>{s.post(route("password.store"),{onFinish:()=>{s.reset("password","password_confirmation")}})};return(C,a)=>(_(),w(v,null,{default:n(()=>[o(e(V),{title:"Reset Password"}),t("form",{onSubmit:k(u,["prevent"])},[t("div",null,[o(l,{for:"email",value:"Email"}),o(m,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e(s).email,"onUpdate:modelValue":a[0]||(a[0]=r=>e(s).email=r),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.email},null,8,["message"])]),t("div",y,[o(l,{for:"password",value:"Password"}),o(m,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:e(s).password,"onUpdate:modelValue":a[1]||(a[1]=r=>e(s).password=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),t("div",x,[o(l,{for:"password_confirmation",value:"Confirm Password"}),o(m,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:e(s).password_confirmation,"onUpdate:modelValue":a[2]||(a[2]=r=>e(s).password_confirmation=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.password_confirmation},null,8,["message"])]),t("div",B,[o(P,{class:g({"opacity-25":e(s).processing}),disabled:e(s).processing},{default:n(()=>[b(" Reset Password ")]),_:1},8,["class","disabled"])])],32)]),_:1}))}});export{j as default};
