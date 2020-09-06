const PlankBoxes = {

  init: function(selector) {
    this.selector = selector
    this.element = $(this.selector)
    this.currentTD = null
    this.currentCellContent = ''

    // EVENTS:
    this.element.on('click', 'td', (e) => {
      console.log('joie');
      this.focus( $(e.target) )
    })
    this.element.on('blur', 'textarea', (e)=>{
      this.blur( $(e.target) )
    })

  },

  focus: function(target) {
    console.log('focus dans le target', target);

    this.selectCell(target)
    const html = this.currentTD.html()
    this.currentTD.html(
      `<textarea>${ html }</textarea>`
    )
    this.currentTD.find('textarea').focus()
  },

  blur: function(target) {
    console.log('blur du target');
    if (this.currentTD) {
      this.currentTD.html(this.currentCellContent)
    }
    this.unselectCell()
  },

  selectCell: function(tdElement) {
    this.currentTD = tdElement
    this.currentCellContent = this.currentTD.html()
  },

  unselectCell: function() {
    this.currentTD = null
    this.currentCellContent = ''
  }

}


$(function() {
  PlankBoxes.init('.boxes');
});
