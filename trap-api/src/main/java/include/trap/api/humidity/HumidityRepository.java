package include.trap.api.humidity;

import org.springframework.data.elasticsearch.repository.ElasticsearchRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface HumidityRepository extends ElasticsearchRepository<Humidity, Long> {

}
