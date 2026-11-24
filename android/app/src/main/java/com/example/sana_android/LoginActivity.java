package com.example.sana_android;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import com.android.volley.Request;
import com.android.volley.toolbox.JsonObjectRequest;
import com.example.sana_android.databinding.ActivityLoginBinding;
import org.json.JSONException;
import org.json.JSONObject;

public class LoginActivity extends AppCompatActivity {

    private ActivityLoginBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityLoginBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        // Se já tiver token guardado, entra direto na MainActivity
        if (!VolleyHelper.getToken(this).isEmpty()) {
            goToMain();
            return;
        }

        binding.btnOpenSettings.setOnClickListener(v ->
                startActivity(new Intent(this, SettingsActivity.class)));

        binding.btnLogin.setOnClickListener(v -> {
            String email = binding.etEmail.getText().toString().trim();
            String password = binding.etPassword.getText().toString().trim();

            if (email.isEmpty() || password.isEmpty()) {
                Toast.makeText(this, "Preenche o email e a palavra-passe.", Toast.LENGTH_SHORT).show();
                return;
            }

            // Atalho para testar a app enquanto a API REST não está online
            if (email.equalsIgnoreCase("teste")) {
                VolleyHelper.saveToken(this, "token_offline_teste");
                goToMain();
                return;
            }

            fazerLoginApi(email, password);
        });
    }

    private void fazerLoginApi(String email, String password) {
        String url = VolleyHelper.getBaseUrl(this) + "/login";

        JSONObject body = new JSONObject();
        try {
            body.put("email", email);
            body.put("password", password);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        JsonObjectRequest request = new JsonObjectRequest(
                Request.Method.POST,
                url,
                body,
                response -> {
                    String token = response.optString("token", "");
                    if (!token.isEmpty()) {
                        VolleyHelper.saveToken(this, token);
                        goToMain();
                    } else {
                        Toast.makeText(this, "Credenciais inválidas.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> Toast.makeText(this, "Erro de ligação ao servidor API. Verifica as configurações.", Toast.LENGTH_LONG).show()
        );

        VolleyHelper.getInstance(this).addToRequestQueue(request);
    }

    private void goToMain() {
        startActivity(new Intent(this, MainActivity.class));
        finish();
    }
}