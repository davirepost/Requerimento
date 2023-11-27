const btn_imp = document.getElementById("btn_imp")

btn_imp.addEventListener("click", (evt)=>{
    const conteudo = document.getElementById('requerimento').innerHTML
    let estilo = "<style>";
        estilo +=  "body {font-family: Arial, sans-serif; width: 210mm;height: 297mm;margin: 0 auto;padding: 20mm;}"
        estilo +=  "label { display: block;margin-top: 10px;}"
        estilo +=  "input[type='text'],select,textarea {width: 100%;padding: 5px;margin-bottom: 10px;}"
        estilo += "#docentes-container {margin-top: 10px;}"
        estilo += "#docentes-container input {width: 50%;display: inline-block;}"
        estilo += "button {margin-top: 10px;}"
        estilo += "select {width: 100%;}"
        estilo += "textarea {width: 100%;}"
        estilo += "</style>";

    const win = window.open ('', '', 'height = 700, width = 700')

    win.document.write('<html><head>')
    win.document.write('<title> Impressão Requerimento </title>')
    win.document.write(estilo)
    win.document.write('</head><body>')
    win.document.write(conteudo)
    win.document.write('</body> </html>')

    win.print()
    win.close()
})