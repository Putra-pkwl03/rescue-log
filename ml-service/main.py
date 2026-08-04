from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel, Field
import joblib
import pandas as pd
from typing import Dict, Any

# 1. INISIALISASI FASTAPI
app = FastAPI(
    title="API Prediksi Logistik Bencana",
    description="API untuk memprediksi 12 kebutuhan pokok logistik posko pengungsian berbasis Random Forest ML",
    version="1.0.0"
)

# 2. KONFIGURASI CORS
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# 3. LOAD MODEL ML
MODEL_PATH = "model_logistik_rf_komprehensif.pkl"

try:
    model = joblib.load(MODEL_PATH)
    print(f"✅ Model '{MODEL_PATH}' berhasil dimuat!")
except Exception as e:
    print(f"❌ Gagal memuat model: {e}")
    model = None

# 4. SKEMA DATA INPUT (PYDANTIC MODEL)
class LogistikInput(BaseModel):
    total_pengungsi: int = Field(..., example=200, description="Total pengungsi")
    anak_balita: int = Field(..., example=25, description="Jumlah anak balita (0-5 thn)")
    dewasa: int = Field(..., example=130, description="Jumlah orang dewasa")
    ibu_hamil: int = Field(..., example=8, description="Jumlah ibu hamil")
    lansia: int = Field(..., example=25, description="Jumlah lansia")
    disabilitas: int = Field(..., example=12, description="Jumlah disabilitas")
    tipe_tempat: str = Field(..., example="Tenda/Lapangan", description="Tenda/Lapangan | Sekolah | Masjid/Tempat Ibadah | Balai Desa")
    akses_air: str = Field(..., example="Terbatas", description="Cukup | Terbatas | Tidak Ada")
    suhu_celcius: float = Field(..., example=21.0, description="Suhu rata-rata (°C)")
    cuaca: str = Field(..., example="Hujan Deras", description="Cerah | Hujan Deras | Mendung")
    akses_jalan: str = Field(..., example="Hanya Motor", description="Mobil/Truk Bisa Masuk | Hanya Motor | Harus Jalan Kaki")
    lama_pengungsian_hari: int = Field(..., example=5, description="Durasi pengungsian (Hari)")

# 5. MAPPING NAMA TARGET ML
TARGET_MAP = [
    ("beras_kg", "Beras Utama", "Kg"),
    ("makanan_kaleng_pack", "Lauk / Makanan Kaleng", "Pack"),
    ("makanan_bayi_pack", "Makanan Bayi & Balita", "Pack"),
    ("minyak_goreng_liter", "Minyak Goreng", "Liter"),
    ("air_minum_dus", "Air Minum Kemasan", "Dus"),
    ("popok_bayi_pcs", "Popok Bayi", "Pcs"),
    ("popok_dewasa_pcs", "Popok Dewasa", "Pcs"),
    ("pembalut_wanita_pack", "Pembalut Wanita", "Pack"),
    ("hygiene_kit_paket", "Hygiene Kit (Alat Mandi)", "Paket"),
    ("selimut_pcs", "Selimut", "Pcs"),
    ("matras_terpal_pcs", "Matras / Terpal", "Pcs"),
    ("obat_p3k_paket", "Paket Obat / P3K", "Paket")
]

# 6. ENDPOINT CHECK HEALTH
@app.get("/")
def read_root():
    return {
        "status": "online",
        "message": "API Prediksi Logistik Bencana aktif.",
        "model_loaded": model is not None
    }

# 7. ENDPOINT PREDIKSI LOGISTIK
@app.post("/api/v1/predict", response_model=Dict[str, Any])
def predict_logistik(payload: LogistikInput):
    if model is None:
        raise HTTPException(status_code=500, detail="Model Machine Learning belum terisi atau tidak ditemukan.")

    try:
        input_data = payload.dict()
        df_input = pd.DataFrame([input_data])

        predictions = model.predict(df_input)[0]

        hasil_prediksi = []
        ringkasan_dikirim = {}

        for i, (key, label, satuan) in enumerate(TARGET_MAP):
            jumlah = max(0, int(round(predictions[i])))
            
            hasil_prediksi.append({
                "key": key,
                "item": label,
                "jumlah": jumlah,
                "satuan": satuan
            })
            
            ringkasan_dikirim[key] = jumlah

        return {
            "status": "success",
            "input_posko": input_data,
            "prediksi_logistik": hasil_prediksi,
            "ringkasan": ringkasan_dikirim
        }

    except Exception as e:
        raise HTTPException(status_code=400, detail=f"Gagal memproses prediksi: {str(e)}")