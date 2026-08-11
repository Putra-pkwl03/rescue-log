import joblib
import pandas as pd
import os
from schemas.logistik_schema import PengajuanLogistikInput

MODEL_PATH = os.path.join(os.path.dirname(__file__), "..", "model_logistik_rf_komprehensif.pkl")

# Daftar 12 kolom target sesuai urutan dataset
TARGET_COLUMNS = [
    'beras_kg',
    'makanan_kaleng_pack',
    'makanan_bayi_pack',
    'minyak_goreng_liter',
    'air_minum_dus',
    'popok_bayi_pcs',
    'popok_dewasa_pcs',
    'pembalut_wanita_pack',
    'hygiene_kit_paket',
    'selimut_pcs',
    'matras_terpal_pcs',
    'obat_p3k_paket'
]

try:
    model = joblib.load(MODEL_PATH)
    print("Model Logistik Multi-Output berhasil dimuat.")
except Exception as e:
    model = None
    print(f"Gagal memuat model: {e}")

def predict(data: PengajuanLogistikInput) -> dict:
    if model is None:
        raise ValueError("Model .pkl belum terisi atau gagal dimuat.")

    input_df = pd.DataFrame([{
        'total_pengungsi': data.total_pengungsi,
        'anak_balita': data.anak_balita,
        'dewasa': data.dewasa,
        'ibu_hamil': data.ibu_hamil,
        'lansia': data.lansia,
        'disabilitas': data.disabilitas,
        'tipe_tempat': data.tipe_tempat,
        'akses_air': data.akses_air,
        'suhu_celcius': data.suhu_celcius,
        'cuaca': data.cuaca,
        'akses_jalan': data.akses_jalan,
        'lama_pengungsian_hari': data.lama_pengungsian_hari
    }])

    # Model mengembalikan array 2D berbentuk (1, 12)
    predictions = model.predict(input_df)[0]

    # Pemetaan array ke key dictionary masing-masing barang
    hasil_detail = {
        col: round(float(val), 2)
        for col, val in zip(TARGET_COLUMNS, predictions)
    }

    return hasil_detail