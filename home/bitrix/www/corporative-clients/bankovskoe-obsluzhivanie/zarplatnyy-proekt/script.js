$(document).ready(function() {
  $('.zp-cards__tab').click(function() {
    const currentBlock = $('.zp-cards__table[data-zp-card-active="true"]')
    const currentImage = $('.zp-cards__image img[data-zp-card-active="true"]')
    const activeBlockName = $(this).data('zp-card')

    if (currentBlock.attr('id') !== activeBlockName) {
      $('.zp-cards__tab--active').removeClass('zp-cards__tab--active')
      $(this).addClass('zp-cards__tab--active')

      currentBlock.attr({'data-zp-card-active': 'false'})
      currentImage.attr({'data-zp-card-active': 'false'})

      $(`#${activeBlockName}`).attr({'data-zp-card-active': 'true'})
      $(`#${activeBlockName}-image`).attr({'data-zp-card-active': 'true'})
    }
  })
})