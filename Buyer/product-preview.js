(() => {
  const cards = Array.from(document.querySelectorAll('.js-product-preview'));
  const backdrop = document.getElementById('bhProductPreview');
  const closeBtn = document.getElementById('bhPreviewClose');
  const img = document.getElementById('bhPreviewImage');
  const title = document.getElementById('bhPreviewTitle');
  const price = document.getElementById('bhPreviewPrice');
  const category = document.getElementById('bhPreviewCategory');
  const description = document.getElementById('bhPreviewDescription');
  const addProductId = document.getElementById('bhPreviewAddProductId');
  const buyProductId = document.getElementById('bhPreviewBuyProductId');

  if (!cards.length || !backdrop || !closeBtn || !img || !title || !price || !category || !description || !addProductId || !buyProductId) {
    return;
  }

  let lastActiveCard = null;

  const openPreview = (card) => {
    const data = card.dataset;
    title.textContent = data.name || '';
    price.textContent = data.price || '';
    category.textContent = data.category || '';
    description.value = data.description || '';
    img.src = data.image || '';
    img.alt = data.name || 'Product image';
    addProductId.value = data.productId || '';
    buyProductId.value = data.productId || '';

    lastActiveCard = card;
    backdrop.hidden = false;
    document.body.classList.add('bh-preview-open');
    closeBtn.focus();
  };

  const closePreview = () => {
    backdrop.hidden = true;
    document.body.classList.remove('bh-preview-open');
    if (lastActiveCard) {
      lastActiveCard.focus();
    }
  };

  cards.forEach((card) => {
    card.addEventListener('click', (event) => {
      if (event.target.closest('form, button, input, select, textarea, a, label')) {
        return;
      }
      openPreview(card);
    });

    card.addEventListener('keydown', (event) => {
      if (event.target.closest('form, button, input, select, textarea, a, label')) {
        return;
      }
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        openPreview(card);
      }
    });
  });

  closeBtn.addEventListener('click', closePreview);

  backdrop.addEventListener('click', (event) => {
    if (event.target === backdrop) {
      closePreview();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && !backdrop.hidden) {
      closePreview();
    }
  });
})();
