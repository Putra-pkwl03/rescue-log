from fastapi import APIRouter, HTTPException
from schemas.logistik_schema import PengajuanLogistikInput, PrediksiResponse
from services.model_service import predict

router = APIRouter(prefix="/predict", tags=["Prediksi Logistik"])

@router.post("", response_model=PrediksiResponse)
def get_prediction(data: PengajuanLogistikInput):
    try:
        hasil_detail = predict(data)
        return {
            "status": "success",
            "estimasi_kebutuhan": hasil_detail
        }
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))