import{_}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-BX7-WNjT.js";import{d as f,c as s,a,u as r,w as o,F as p,o as l,Z as g,t as i,g as u,b as e,i as c,h as d,r as m}from"./app-BxpyNJtY.js";import"./ApplicationLogo-B3ipU6lz.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const x=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," 教育管理 ",-1),b={key:0,class:"w-full p-8 bg-blue-300 text-white"},y={key:1,class:"w-full p-8 bg-red-300 text-white"},F={class:"flex items-center justify-between mb-4 bg-green-300"},w=e("div",null,null,-1),v={class:"px-64 py-4"},$={class:"bg-[#FFFFFF] mx-4 my-2"},k={class:"w-full text-sm text-left text-gray-500"},N=e("thead",{class:"text-xs text-gray-700 uppercase bg-[#F4F4F4]"},[e("tr",null,[e("th",{scope:"col",class:"py-3 px-6"},"タイトル"),e("th",{scope:"col",class:"py-3 px-6"},"操作")])],-1),V={class:"bg-white border-b"},B={class:"py-4 px-6"},C={class:"py-4 px-6"},L=f({__name:"Index",props:{educations:Array},setup(h){return(t,E)=>(l(),s(p,null,[a(r(g),{title:"教育管理"}),a(_,null,{header:o(()=>[x]),default:o(()=>[t.$page.props.flash.status==="sucess"?(l(),s("div",b,i(t.$page.props.flash.message),1)):u("",!0),t.$page.props.flash.status==="danger"?(l(),s("div",y,i(t.$page.props.flash.message),1)):u("",!0),e("div",F,[w,e("div",v,[a(r(c),{as:"button",href:t.route("education.create"),class:"bg-[#5568FE] text-white px-4 py-2 rounded"},{default:o(()=>[d(" 登録 ")]),_:1},8,["href"])])]),e("div",$,[e("table",k,[N,e("tbody",null,[(l(!0),s(p,null,m(h.educations,n=>(l(),s("tr",V,[e("td",B,i(n.title),1),e("td",C,[a(r(c),{as:"button",href:t.route("education.show",{education:n.id}),class:"bg-[#F5F5F5] text-[#394264] px-3 py-1 rounded"},{default:o(()=>[d(" 詳細 ")]),_:2},1032,["href"]),d("      "),a(r(c),{as:"button",href:t.route("education.edit",{education:n.id}),class:"bg-[#F5F5F5] text-[#394264] px-4 py-1 rounded"},{default:o(()=>[d(" 編集 ")]),_:2},1032,["href"])])]))),256))])])])]),_:1})],64))}});export{L as default};