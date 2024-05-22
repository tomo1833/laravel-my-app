import{A as M}from"./ApplicationLogo-B3ipU6lz.js";import{d as h,aK as N,aP as j,k as y,aY as D,c as m,b as e,m as c,f as C,bv as L,a as o,w as a,G as E,o as l,n as u,j as w,u as b,i as k,t as x,g as z,h as n}from"./app-BxpyNJtY.js";const S={class:"relative"},V=h({__name:"Dropdown",props:{align:{default:"right"},width:{default:"48"},contentClasses:{default:"py-1 bg-white dark:bg-gray-700"}},setup(d){const r=d,t=f=>{i.value&&f.key==="Escape"&&(i.value=!1)};N(()=>document.addEventListener("keydown",t)),j(()=>document.removeEventListener("keydown",t));const s=y(()=>({48:"w-48"})[r.width.toString()]),p=y(()=>r.align==="left"?"ltr:origin-top-left rtl:origin-top-right start-0":r.align==="right"?"ltr:origin-top-right rtl:origin-top-left end-0":"origin-top"),i=D(!1);return(f,g)=>(l(),m("div",S,[e("div",{onClick:g[0]||(g[0]=$=>i.value=!i.value)},[c(f.$slots,"trigger")]),C(e("div",{class:"fixed inset-0 z-40",onClick:g[1]||(g[1]=$=>i.value=!1)},null,512),[[L,i.value]]),o(E,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"opacity-0 scale-95","enter-to-class":"opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"opacity-100 scale-100","leave-to-class":"opacity-0 scale-95"},{default:a(()=>[C(e("div",{class:u(["absolute z-50 mt-2 rounded-md shadow-lg",[s.value,p.value]]),style:{display:"none"},onClick:g[2]||(g[2]=$=>i.value=!1)},[e("div",{class:u(["rounded-md ring-1 ring-black ring-opacity-5",f.contentClasses])},[c(f.$slots,"content")],2)],2),[[L,i.value]])]),_:3})]))}}),B=h({__name:"DropdownLink",props:{href:{}},setup(d){return(r,t)=>(l(),w(b(k),{href:r.href,class:"block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out"},{default:a(()=>[c(r.$slots,"default")]),_:3},8,["href"]))}}),v=h({__name:"NavLink",props:{href:{},active:{type:Boolean}},setup(d){const r=d,t=y(()=>r.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out");return(s,p)=>(l(),w(b(k),{href:s.href,class:u(t.value)},{default:a(()=>[c(s.$slots,"default")]),_:3},8,["href","class"]))}}),_=h({__name:"ResponsiveNavLink",props:{href:{},active:{type:Boolean}},setup(d){const r=d,t=y(()=>r.active?"block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 dark:border-indigo-600 text-start text-base font-medium text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 focus:bg-indigo-100 dark:focus:bg-indigo-900 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out":"block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out");return(s,p)=>(l(),w(b(k),{href:s.href,class:u(t.value)},{default:a(()=>[c(s.$slots,"default")]),_:3},8,["href","class"]))}}),A={class:"min-h-screen bg-gray-100 dark:bg-gray-900"},O={class:"bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700"},P={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},T={class:"flex justify-between h-16"},G={class:"flex"},K={class:"shrink-0 flex items-center"},R={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},U={class:"hidden sm:flex sm:items-center sm:ms-6"},Y={class:"ms-3 relative"},q={class:"inline-flex rounded-md"},F={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"},H=e("svg",{class:"ms-2 -me-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[e("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1),I={class:"-me-2 flex items-center sm:hidden"},J={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},Q={class:"pt-2 pb-3 space-y-1"},W={class:"pt-4 pb-1 border-t border-gray-200 dark:border-gray-600"},X={class:"px-4"},Z={class:"font-medium text-base text-gray-800 dark:text-gray-200"},ee={class:"font-medium text-sm text-gray-500"},te={class:"mt-3 space-y-1"},re={key:0,class:"bg-white dark:bg-gray-800 shadow"},ae={class:"max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"},ne=h({__name:"AuthenticatedLayout",setup(d){const r=D(!1);return(t,s)=>(l(),m("div",null,[e("div",A,[e("nav",O,[e("div",P,[e("div",T,[e("div",G,[e("div",K,[o(b(k),{href:t.route("dashboard")},{default:a(()=>[o(M,{class:"block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"})]),_:1},8,["href"])]),e("div",R,[o(v,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:a(()=>[n(" Dashboard ")]),_:1},8,["href","active"]),o(v,{href:t.route("attendance.index"),active:t.route().current("attendance.index")},{default:a(()=>[n(" 勤怠管理 ")]),_:1},8,["href","active"]),o(v,{href:t.route("education.index"),active:t.route().current("education.index")},{default:a(()=>[n(" 教育管理 ")]),_:1},8,["href","active"]),o(v,{href:t.route("camera.index"),active:t.route().current("camera.index")},{default:a(()=>[n(" カメラ ")]),_:1},8,["href","active"])])]),e("div",U,[e("div",Y,[o(V,{align:"right",width:"48"},{trigger:a(()=>[e("span",q,[e("button",F,[n(x(t.$page.props.auth.user.name)+" ",1),H])])]),content:a(()=>[o(B,{href:t.route("profile.edit")},{default:a(()=>[n(" Profile ")]),_:1},8,["href"]),o(B,{href:t.route("logout"),method:"post",as:"button"},{default:a(()=>[n(" Log Out ")]),_:1},8,["href"])]),_:1})])]),e("div",I,[e("button",{onClick:s[0]||(s[0]=p=>r.value=!r.value),class:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"},[(l(),m("svg",J,[e("path",{class:u({hidden:r.value,"inline-flex":!r.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),e("path",{class:u({hidden:!r.value,"inline-flex":r.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e("div",{class:u([{block:r.value,hidden:!r.value},"sm:hidden"])},[e("div",Q,[o(_,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:a(()=>[n(" Dashboard ")]),_:1},8,["href","active"])]),e("div",W,[e("div",X,[e("div",Z,x(t.$page.props.auth.user.name),1),e("div",ee,x(t.$page.props.auth.user.email),1)]),e("div",te,[o(_,{href:t.route("profile.edit")},{default:a(()=>[n(" Profile ")]),_:1},8,["href"]),o(_,{href:t.route("logout"),method:"post",as:"button"},{default:a(()=>[n(" Log Out ")]),_:1},8,["href"])])])],2)]),t.$slots.header?(l(),m("header",re,[e("div",ae,[c(t.$slots,"header")])])):z("",!0),e("main",null,[c(t.$slots,"default")])])]))}});export{ne as _};