  <div class="tbk-shadow-2 tbk-card ">
      <form id="card-form" method="POST" action="{{ $action }}">
          <div class="card-container">
              <div class="card-wrapper mb-4"></div>

              @csrf
              <div class="card-inputs-container">

                  <div class="input-container mb-3">
                      <label for="number" class="tbk-label">Número de tarjeta</label>
                      <input type="text" id="number" name="number" class="tbk-input-text" required
                          value="4051885600446623">
                  </div>

                  <div class="card-split-inputs">
                      <div class="col-6 input-container mb-3">
                          <label for="expiry" class="tbk-label">Fecha de Vencimiento (MM/YY)</label>
                          <input type="text" id="expiry" name="expiry" class="tbk-input-text" required
                              value="11/23">
                      </div>
                      <div class="col-6 input-container mb-3">
                          <label for="cvc" class="tbk-label">CVC</label>
                          <input type="text" id="cvc" name="cvc" class="tbk-input-text" required
                              value="123">
                          <input type="hidden" id="name" name="name" class="tbk-input-text" required
                              value="test user">
                      </div>
                  </div>
              </div>
              <div class="card-border"></div>
              <div class="card-footer">
                  <img src={{ asset('images/credit.svg') }} class="arrow" alt="credit cards logos" width="230"
                      height="36" />
                  <button type="submit" class="tbk-button primary mb-32">Pagar</button>
              </div>
          </div>
      </form>
  </div>

  @push('scripts')
      <script>
          function initializeCard() {


              if (typeof Card !== 'undefined' && document.querySelector('.card-wrapper')) {
                  new Card({
                      form: '#card-form',
                      container: '.card-wrapper',

                      formSelectors: {
                          number: 'input[name="number"]',
                          name: 'input[name="name"]',
                          expiry: 'input[name="expiry"]',
                          cvc: 'input[name="cvc"]'
                      },
                      width: 300,
                      formatting: true,
                      messages: {
                          valid: 'válido\n'
                      },
                      placeholders: {
                          number: '•••• •••• •••• ••••',
                          name: 'Nombre Completo',
                          expiry: 'MM/YY',
                          cvc: 'CVC'
                      },
                      defaults: {
                          number: '4051 8856 0044 6623',
                          name: 'Nombre Completo',
                          expiry: '11/23',
                          cvc: '123'
                      }
                  });
              }


          }


          document.addEventListener('DOMContentLoaded', () => {
              initializeCard();

              const inputs = document.querySelectorAll(
                  'input[name="cardNumber"], input[name="cardExpirationDate"], input[name="cvv"]'
              );

              inputs.forEach(input => {
                  if (input.value && input.value.trim() !== '') {
                      const event = new Event('input', {
                          bubbles: true
                      });

                      input.dispatchEvent(event);
                  }
              });
          });
      </script>
  @endpush
