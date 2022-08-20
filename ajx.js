//--------------------------------------------------
//------------------------Form----------------------
//--------------------------------------------------
var xmlUpload = addEventListener("submit", uploadXml);


 async function uploadXml(e) {
    e.preventDefault();
    let upload = document.getElementsByName('uploadXml');
    upload = new FormData(upload[0]);
    let request = await fetch("retornaDados.php", {
        method: "POST",
        body: upload
    });
   if (request.status !== 200) {
      alert('Problemas na Conversão');
      return;
   }

    let response = await request.json();
    /**
     * Generated PDF
     */
     var base64 = (response)
     const blob = base64ToBlob( base64, 'application/pdf' );
     const url = URL.createObjectURL( blob );
     const pdfWindow = window.open("");
     pdfWindow.document.write("<iframe width='100%' height='100%' src='" + url + "'></iframe>");
     
    limpaForm();
 }


//--------------------------------------------------
// LIMPA FORM
//--------------------------------------------------
 function limpaForm() {
    document.getElementsByName('uploadXml')[0].reset();
 }

 // ------------------------------------------------
 // open Popup
 // ------------------------------------------------
 function base64ToBlob( base64, type = "application/octet-stream" ) {
   const binStr = atob( base64 );
   const len = binStr.length;
   const arr = new Uint8Array(len);
   for (let i = 0; i < len; i++) {
     arr[ i ] = binStr.charCodeAt( i );
   }
   return new Blob( [ arr ], { type: type } );
 }

