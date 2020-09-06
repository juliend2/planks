const PlankBoxes = {

  init: function(selector, plankID) {
    this.selector = selector
    this.plankID = plankID
    this.element = $(this.selector)
    this.currentTD = null
    this.currentCellContent = ''

    // EVENTS:
    this.element.on('click', 'td', (e) => {
      this.focus( $(e.target) )
    })
    this.element.on('blur', 'textarea', (e)=>{
      this.blur( $(e.target) )
    })

  },

  focus: function(target) {
    console.log('focus dans le target', target);

    if ( this.isEditing() ) {
      return false;
    } else {
      this.selectCell(target)
      const html = this.currentTD.html()
      this.currentTD.html(
        `<textarea>${ $.trim(html) }</textarea>`
      )
      this.currentTD.find('textarea').focus()
    }
  },

  blur: function(target) {
    // console.log('blur du target');
    // console.log(
    //   $.trim(this.currentTD.find('textarea').val()),
    //   $.trim(this.currentCellContent)
    // )
    if ( $.trim(target.val()) != $.trim(this.currentCellContent) ) {
      const id = this.currentTD.data('id')
      const x = this.currentTD.data('x')
      const y = this.currentTD.data('y')
      const newContent = this.currentTD.find('textarea').val()
      this.upsertCell(id, x, y, newContent, (data, textStatus)=>{
        console.log('success', data, textStatus)
        this.currentTD.html(newContent)
        this.unselectCell(newContent) // whipe out state
      });
    }
  },

  selectCell: function(tdElement) {
    this.currentTD = tdElement
    this.currentCellContent = this.currentTD.html()
  },

  upsertCell: function(id, x, y, content, callback) {
    // New content; Gonna save
    $.post('/box.php', {
      id: id,
      plank_id: this.plankID,
      x_cell: x,
      y_cell: y,
      content: content
    }, callback, 'json');
  },

  unselectCell: function(newCellContent = '') {
    this.currentTD = null
    this.currentCellContent = newCellContent
  },

  isEditing: function() {
    return this.currentTD !== null
  }

}


