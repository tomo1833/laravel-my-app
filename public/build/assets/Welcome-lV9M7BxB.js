import{d as c,c as s,b as t,j as i,w as o,u as n,F as d,a as h,g as l,o as r,h as u,i as a}from"./app-BxpyNJtY.js";const f={class:"flex flex-col h-screen items-center justify-center bg-green-300 text-black/50 dark:bg-black dark:text-white/50"},g={class:"h-16 py-1 bg-white w-full"},b={key:0,class:"flex flex-1 justify-end pr-8"},p=t("div",{class:"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"}," Log in ",-1),x=t("div",{class:"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"}," Register ",-1),k=t("main",{class:"flex-1 flex flex-col items-center justify-center"},[t("h1",{class:"text-center text-4xl font-bold"},"基幹システム")],-1),v=t("footer",{class:"h-10 py-2 items-center bg-white w-full text-center flex justify-center"}," © 2024 tomo. All rights reserved. ",-1),y=c({__name:"Welcome",props:{canLogin:{type:Boolean},canRegister:{type:Boolean},laravelVersion:{},phpVersion:{}},setup(_){return(e,m)=>(r(),s("div",f,[t("header",g,[e.canLogin?(r(),s("nav",b,[e.$page.props.auth.user?(r(),i(n(a),{key:0,href:e.route("dashboard"),class:"rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"},{default:o(()=>[u(" Dashboard ")]),_:1},8,["href"])):(r(),s(d,{key:1},[h(n(a),{href:e.route("login"),class:"rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"},{default:o(()=>[p]),_:1},8,["href"]),e.canRegister?(r(),i(n(a),{key:0,href:e.route("register"),class:"rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"},{default:o(()=>[x]),_:1},8,["href"])):l("",!0)],64))])):l("",!0)]),k,v]))}});export{y as default};