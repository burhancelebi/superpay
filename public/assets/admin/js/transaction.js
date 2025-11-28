const merchantsSelect = document.querySelector('select[name="merchants"]');
const paymentSystemsSelect = document.querySelector('select[name="payment-systems"]');
const installmentSelect = document.querySelector('select[name="installment"]');
const paymentRateInput = document.querySelector('input[name="payment_system_rate"]');

function transactionFormDefaultDisabled() {
    paymentSystemsSelect.disabled = true;
    installmentSelect.disabled = true;
    paymentRateInput.disabled = true;
}

document.addEventListener('DOMContentLoaded', function() {
    let installmentData = [];

    merchantsSelect.addEventListener('change', function() {
        const merchantId = this.value;
        let url = window.routes.merchantPaymentSystems.replace(':id', merchantId);

        paymentSystemsSelect.disabled = true;
        installmentSelect.disabled = true;
        paymentRateInput.disabled = true;
        paymentRateInput.value = '';

        if (merchantId !== '') {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // payment-systems select doldurma
                    paymentSystemsSelect.innerHTML = '<option value="">Ödeme Sistemi seçin...</option>';
                    data.data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.name;
                        paymentSystemsSelect.appendChild(option);
                    });
                    paymentSystemsSelect.disabled = false;
                })
                .catch(() => alert("Ödeme sistemleri yüklenirken hata oluştu."));
        }
    });

    paymentSystemsSelect.addEventListener('change', function() {
        const paymentSystemId = this.value;
        const merchantId = merchantsSelect.value;
        let url = window.routes.paymentSystemRates
            .replace(':id', paymentSystemId)
            .replace(':merchantId', merchantId);

        paymentRateInput.value = '';
        installmentSelect.innerHTML = '<option value="">Taksit sayısı</option>';
        installmentSelect.disabled = true;

        if (paymentSystemId !== '') {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    installmentData = data.data;
                    installmentSelect.innerHTML = '<option value="">Taksit seçenekleri</option>';
                    data.data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.installment;
                        option.textContent = item.installment;
                        installmentSelect.appendChild(option);
                    });
                    installmentSelect.disabled = false;
                })
                .catch(() => alert("Ödeme sistemi oranları alınırken hata oluştu."));
        }
    });

    // Installment change
    installmentSelect.addEventListener('change', function() {
        const selectedId = this.value;
        paymentRateInput.value = '';
        paymentRateInput.disabled = false;

        if (selectedId) {
            const selectedItem = installmentData.find(item => item.installment == selectedId);
            if (selectedItem) {
                paymentRateInput.value = selectedItem.rate;
            }
        }
    });
});

function removeDisabled() {
    paymentSystemsSelect.disabled = false;
    installmentSelect.disabled = false;
    paymentRateInput.disabled = false;
}

document.addEventListener('click', function (e) {
    if (e.target.closest('.partial-payment')) {
        let transactionId = e.target.closest('.partial-payment').dataset.id;
        document.querySelector('#store-partial-payment input[name="transaction_id"]').value = transactionId;
    }
});
document.querySelector('#partial-payment-submit-button').addEventListener('click', function (e) {
    e.preventDefault();

    let form = document.querySelector('#store-partial-payment');
    let formData = new FormData(form);

    fetch(form.getAttribute('action'), {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest', // Laravel için faydalı olabilir
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(async response => {
            if (!response.ok) {
                throw response;
            }
            return response.json();
        })
        .then(data => {
            toast().success('Parçalı ödeme başarıyla kaydedildi.');
            setTimeout(() => location.reload(), 3000);
        })
        .catch(async error => {
            // response objesini JSON olarak parse et
            if (error.status === 422) {
                const data = await error.json();
                let messages = Object.values(data.errors).flat().join('<br>');
                toast().error(messages);
            } else {
                toast().error('Bir hata oluştu. Lütfen tekrar deneyin.');
            }
        });
});

function initDateTimePicker() {
    document.querySelectorAll(".kt_datetimepicker").forEach(function(el) {
        flatpickr(el, {
            enableTime: true,
            time_24hr: true,
            dateFormat: "Y-m-d H:i",
            allowInput: true,
            locale: "tr"
        });
    });
}

