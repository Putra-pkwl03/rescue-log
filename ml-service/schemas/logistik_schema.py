from pydantic import BaseModel, Field

class PengajuanLogistikInput(BaseModel):
    total_pengungsi: int = Field(..., ge=0, example=150)
    anak_balita: int = Field(..., ge=0, example=20)
    dewasa: int = Field(..., ge=0, example=100)
    ibu_hamil: int = Field(..., ge=0, example=5)
    lansia: int = Field(..., ge=0, example=20)
    disabilitas: int = Field(..., ge=0, example=5)
    tipe_tempat: str = Field(..., example="Balai Desa")
    akses_air: str = Field(..., example="Cukup")
    suhu_celcius: float = Field(..., example=28.5)
    cuaca: str = Field(..., example="Hujan Deras")
    akses_jalan: str = Field(..., example="Mobil/Truk Bisa Masuk")
    lama_pengungsian_hari: int = Field(..., ge=1, example=3)

class DetailKebutuhanLogistik(BaseModel):
    beras_kg: float
    makanan_kaleng_pack: float
    makanan_bayi_pack: float
    minyak_goreng_liter: float
    air_minum_dus: float
    popok_bayi_pcs: float
    popok_dewasa_pcs: float
    pembalut_wanita_pack: float
    hygiene_kit_paket: float
    selimut_pcs: float
    matras_terpal_pcs: float
    obat_p3k_paket: float

class PrediksiResponse(BaseModel):
    status: str
    estimasi_kebutuhan: DetailKebutuhanLogistik