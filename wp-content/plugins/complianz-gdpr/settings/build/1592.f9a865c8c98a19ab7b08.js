"use strict";(globalThis.webpackChunkcomplianz_gdpr=globalThis.webpackChunkcomplianz_gdpr||[]).push([[1592,9819],{19819:(e,t,a)=>{a.r(t),a.d(t,{default:()=>s});var n=a(51280),c=a(95959),l=a(15832),o=a(25536),d=a(93396);const s=e=>{const{saving:t,updateDocument:a}=(0,c.UseDocumentsData)(),{showSavedSettingsNotice:s}=(0,o.default)();let r=!!e.page.page_id;return(0,n.createElement)("div",{className:"cmplz-create-document"},r&&(0,n.createElement)(l.default,{name:"success",color:"green"}),!r&&(0,n.createElement)(l.default,{name:"times"}),(0,n.createElement)("input",{disabled:t,onChange:t=>((e,t)=>{a(t,e.target.value)})(t,e.page.page_id),type:"text",value:e.page.title}),(0,n.createElement)("div",{className:"cmplz-shortcode-container",onClick:t=>((e,t)=>{let a;e.target.classList.add("cmplz-click-animation");let n=document.createElement("input");document.getElementsByTagName("body")[0].appendChild(n),n.value=t,n.select();try{a=document.execCommand("copy")}catch(e){a=!1}n.parentElement.removeChild(n),a&&s((0,d.__)("Copied shortcode","complianz-gdpr"))})(t,e.page.shortcode)},(0,n.createElement)(l.default,{name:"shortcode"})))}},71592:(e,t,a)=>{a.r(t),a.d(t,{default:()=>m});var n=a(51280),c=a(93396),l=a(95959),o=a(19819),d=a(88496),s=a(25536),r=a(60312),i=a(15832);const m=(0,d.memo)((()=>{const{saveDocuments:e,saving:t,documentsChanged:a,documentsDataLoaded:m,hasMissingPages:u,fetchDocumentsData:p,requiredPages:g}=(0,l.UseDocumentsData)(),{fields:h,fieldsLoaded:f,changedFields:_,addHelpNotice:b,removeHelpNotice:v,showSavedSettingsNotice:E,setDocumentSettingsChanged:z}=(0,s.default)(),[y,C]=(0,d.useState)(!1);let k;if((0,d.useEffect)((()=>{f&&(_.length>0||p())}),[h,_]),(0,d.useEffect)((()=>{if(m)if(0===g.length){let e=(0,c.__)("You haven't selected any legal documents to create.","complianz-gdpr")+" "+(0,c.__)("You can continue to the next step.","complianz-gdpr");b("create-documents","warning",e,(0,c.__)("No required documents","complianz-gdpr")),C(!0)}else y&&v("create-documents")}),[g,m]),k=u?(0,c.__)('The pages marked with X should be added to your website. You can create these pages with a shortcode, a Gutenberg block or use the below "Create missing pages" button.',"complianz-gdpr"):(0,c.__)('All necessary pages have been created already. You can update the page titles here if you want, then click the "Update pages" button.',"complianz-gdpr"),!m)return(0,n.createElement)(r.default,{lines:"3"});let D=!u&&!a;return(0,n.createElement)(n.Fragment,null,m&&k,m&&g.map(((e,t)=>(0,n.createElement)(o.default,{page:e,key:t}))),g.length>0&&(0,n.createElement)("div",null,(0,n.createElement)("button",{disabled:D,onClick:()=>(async()=>{e().then((()=>{z(!0),E((0,c.__)("Documents updated!","complianz-gdpr"))}))})(),className:"button button-default"},u?(0,c.__)("Create missing pages","complianz-gdpr"):(0,c.__)("Update","complianz-gdpr"),t&&(0,n.createElement)(i.default,{name:"loading",color:"grey"}))))}))}}]);