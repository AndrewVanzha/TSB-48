function checkTab(className, type) {
  const id = $(this).data(`set-${type}`)
  const blockDataAttr = `data-${type}-active`
  const activeBlockName = type + '-' + id
  const currentBlock = $(`[${blockDataAttr}="true"]`)

  if (currentBlock.attr('id') !== type + '-' + id) {
    $(`.${className}--active`).removeClass(`${className}--active`)
    $(this).addClass(`${className}--active`)
    currentBlock.attr(blockDataAttr, 'false')
    $(`#${activeBlockName}`).attr(blockDataAttr, 'true')
  }
}

$(document).ready(function() {
  $('.oosb-types__tab').click(function() {
    checkTab.call(this, 'oosb-types__tab', 'type')
  })
  $('.oosb-tariffs__tab').click(function() {
    checkTab.call(this, 'oosb-tariffs__tab', 'tariff')
  })
  $('.oosb-docs__tab').click(function() {
    checkTab.call(this, 'oosb-docs__tab', 'docs')
  })
  $('.oosb-types__spoiler').click(function() {
    const activeClassName = 'oosb-types__spoiler--active'
    if (!$(this).hasClass(activeClassName)) {
      $('.' + activeClassName).removeClass(activeClassName)
      $(this).addClass(activeClassName)
    }
  })
})