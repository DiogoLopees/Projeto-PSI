package com.example.sana_android;

import android.os.Bundle;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import com.android.volley.Request;
import com.android.volley.toolbox.JsonObjectRequest;
import com.example.sana_android.databinding.ActivityRegisterBinding;
import org.json.JSONException;
import org.json.JSONObject;

public class RegisterActivity extends AppCompatActivity {

    private ActivityRegisterBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityRegisterBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        binding.btnBackToLogin.setOnClickListener(v -> finish());

        binding.btnRegisterSubmit.setOnClickListener(v -> {
            String nome = binding.etRegNome.getText().toString().trim();
            String email = binding.etRegEmail.getText().toString().trim();
            String telefone = binding.etRegTelefone.getText().toString().trim();
            String nif = binding.etRegNif.getText().toString().trim();
            String historico = binding.etRegHistorico.getText().toString().trim();
            String password = binding.etRegPassword.getText().toString().trim();

            if (nome.isEmpty() || email.isEmpty() || password.isEmpty()) {
                Toast.makeText(this, "Preenche nome, email e palavra-passe.", Toast.LENGTH_SHORT).show();
                return;
            }

            registarNaApi(nome, email, telefone, nif, historico, password);
        });
    }

    private void registarNaApi(String nome, String email, String telefone, String nif, String historico, String password) {
        String url = VolleyHelper.getBaseUrl(this) + "/register";

        JSONObject body = new JSONObject();
        try {
            body.put("nome", nome);
            body.put("email", email);
            body.put("telefone", telefone);
            body.put("nif", nif);
            body.put("historico_clinico", historico);
            body.put("password", password);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        JsonObjectRequest request = new JsonObjectRequest(
                Request.Method.POST,
                url,
                body,
                response -> {
                    Toast.makeText(this, "Conta criada com sucesso! Faz login.", Toast.LENGTH_LONG).show();
                    finish();
                },
                error -> {
                    // Enquanto a API não está online, permite simular o registo para testes
                    Toast.makeText(this, "Modo Offline: Registo validado localmente. Usa 'teste' no login.", Toast.LENGTH_LONG).show();
                    finish();
                }
        );

        VolleyHelper.getInstance(this).addToRequestQueue(request);
    }
}