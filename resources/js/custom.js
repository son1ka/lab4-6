import * as bootstrap from 'bootstrap';

import '../sass/app.scss';

let currentObjectIndex = 0;

function updateModal(index, data) {
    if (index >= 0 && index < data.length) {
        document.getElementById('modalTitle').textContent = data[index].title;
        document.getElementById('modalDescription').innerHTML = data[index].description;

        // Обновление состояния кнопок навигации
        document.getElementById('prevObject').disabled = (index === 0);
        document.getElementById('nextObject').disabled = (index === data.length - 1);

        currentObjectIndex = index;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing...');

    const objectsData = window.objectsData || [];

    if (objectsData.length === 0) {
        console.warn('Предупреждение: window.objectsData не найден или пуст.');
        document.getElementById('prevObject')?.setAttribute('disabled', 'disabled');
        document.getElementById('nextObject')?.setAttribute('disabled', 'disabled');
        return;
    }

    // Обработчик клика по карточке
    document.querySelectorAll('.card-wrapper').forEach((card, index) => {
        card.addEventListener('click', () => {
            updateModal(index, objectsData);
        });
    });

    // Обработчики навигации в модальном окне
    document.getElementById('prevObject').addEventListener('click', () => {
        if (currentObjectIndex > 0) {
            updateModal(currentObjectIndex - 1, objectsData);
        }
    });

    document.getElementById('nextObject').addEventListener('click', () => {
        if (currentObjectIndex < objectsData.length - 1) {
            updateModal(currentObjectIndex + 1, objectsData);
        }
    });

    // Обработчик нажатия клавиш в модальном окне
    document.getElementById('detailModal').addEventListener('keydown', (event) => {
        // Проверяем, что фокус на модальном окне или его дочернем элементе
        if (event.target.closest('#detailModal')) {
            if (event.key === 'ArrowLeft') {
                if (currentObjectIndex > 0) {
                    updateModal(currentObjectIndex - 1, objectsData);
                }
            } else if (event.key === 'ArrowRight') {
                if (currentObjectIndex < objectsData.length - 1) {
                    updateModal(currentObjectIndex + 1, objectsData);
                }
            }
        }
    });

    // Обработчик кнопки "Загрузить" для показа Toast
    document.getElementById('loadButton').addEventListener('click', () => {
        const toastEl = document.getElementById('loadToast');
        let toastInstance = bootstrap.Toast.getInstance(toastEl);
        if (toastInstance) {
            toastInstance.show();
        } else {
            toastInstance = new bootstrap.Toast(toastEl);
            toastInstance.show();
        }
    });

    console.log('All event listeners initialized');
});

// Обработчик события показа модального окна
document.getElementById('detailModal').addEventListener('shown.bs.modal', function () {
    console.log('Modal shown');
    this.focus();
});

// Обработчик события скрытия модального окна
document.getElementById('detailModal').addEventListener('hidden.bs.modal', function () {
    console.log('Modal hidden');
});
